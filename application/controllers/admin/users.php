<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Users extends MY_Controller
{
    
    public function __construct()
    {
        parent::__construct();
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
            redirect('admin/users');
        }
        
        $this->template->render('admin/users/create', array('errors' => $this->form_validation->errors()));
    }

    public function action_delete($id)
    {
        $this->user_model->delete($id);
        redirect('admin/users');
    }
}
