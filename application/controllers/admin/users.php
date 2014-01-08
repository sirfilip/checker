<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Users extends MY_Controller
{
    
    public function __construct()
    {
        parent::__construct();
        $this->require_admin();
        $this->load->model('user_model');
    }

    public function action_index()
    {
        $users = $this->user_model->plain_users()->all();
        $this->template->render('admin/users/index', array('users' => $users));
    }
    
    public function action_create()
    {
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('username', 'Username', 'required|xss_clean|is_unique[users.username]');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|xss_clean|is_unique[users.email]');
        $this->form_validation->set_rules('password', 'Password', 'required|matches[passconf]');
        $this->form_validation->set_rules('passconf', 'Confirmation', 'required');
        
        if ($this->request->is_post() and $this->form_validation->run())
        {
            $this->user_model->create(array(
                'username' => $this->input->post('username', TRUE),
                'email' => $this->input->post('email', TRUE),
                'password' => $this->input->post('password'),
            ));
            $this->session->set_flashdata('success', 'User created successfully');
            redirect('admin/users');
        }
        
        $this->template->render('admin/users/create', array('errors' => $this->form_validation->errors()));
    }

    public function action_delete($id)
    {
        $this->user_model->delete($id);
        $this->session->set_flashdata('success', 'User deleted successfully');
        redirect('admin/users');
    }
    
    public function action_report($id, $offset=0)
    {
        $this->load->model('checkin_model');
        
        $this->load->library('pagination');
        $this->pagination->initialize(array(
            'base_url' => site_url("admin/users/report/{$id}"),
            'total_rows' => $this->checkin_model->checkout_history_for($id)->count(),
            'per_page' => 10,
            'uri_segment' => 5,
        ));
        $checkout_history = $this->checkin_model
                                 ->checkout_history_for($id)
                                 ->paginate($offset)
                                 ->all();
        $this->template->render('admin/users/report', array(
            'user' => $this->user_model->find_by_id($id),
            'checkout_history' => $checkout_history,
            'pagination' => $this->pagination->create_links(),
        ));
    }
}
