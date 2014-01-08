<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Dashboard extends MY_Controller {
    
    
    protected function before()
    {
        $this->require_authentication();
        $this->load->model('checkin_model');
    }


    public function action_index($offset = 0)
    {
        $this->load->library('pagination');
        $this->pagination->initialize(array(
            'base_url' => site_url('dashboard/index'),
            'total_rows' => $this->checkin_model->checkout_history_for($this->auth->current_user()->id)->count(),
            'per_page' => 10,
        ));
        
        $checkin_in_progress = $this->checkin_model->checkin_in_progress_for($this->auth->current_user()->id);
        $checkout_history = $this->checkin_model
                                 ->checkout_history_for($this->auth->current_user()->id)
                                 ->paginate($offset)
                                 ->all();
        $this->template->render('dashboard/index', array(
            'checkin_in_progress' => $checkin_in_progress,
            'checkout_history' => $checkout_history,
            'pagination' => $this->pagination->create_links(),
        ));
    }
    
    
    public function action_checkin()
    {
        if (! $this->checkin_model->checkin($this->auth->current_user()))
        {
            $this->session->set_flashdata('danger', $this->checkin_model->error());
        }
        else
        {
            $this->session->set_flashdata('success', 'Checked in successfully.');
        }
        redirect('dashboard');
    }
    
    public function action_checkout()
    {
       if ($this->checkin_model->checkout($this->auth->current_user(), $this->input->post('description', TRUE)))
       {
           $this->session->set_flashdata('success', 'Checked out successfully');
       }
       else
       {
           $this->session->set_flashdata('danger', $this->checkin_model->error());
       }
       redirect('dashboard');
    }
    
    
    public function action_change_password()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('password', 'Password', 'required|matches[passconf]');
        $this->form_validation->set_rules('passconf', 'Confirmation', 'required');
        
        if ($this->request->is_post() and $this->form_validation->run())
        {
            $this->load->model('user_model');
            $this->user_model->change_password($this->auth->current_user(), $this->input->post('password'));
            $this->session->set_flashdata('success', 'Password changed successfully');
            redirect('dashboard');
        }
        
        $this->template->render('dashboard/change_password', array(
           'errors' => $this->form_validation->errors(), 
        ));
    }
    
    
}
