<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Sessions extends MY_Controller {

    public function action_create()
    {
        $this->template->set_template('single');
        
        $this->load->library('form_validation');
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
     
        $error = '';
        
        if ($this->request->is_post())
        {
            if ($this->form_validation->run() and $this->auth->authenticate($this->input->post('username'), $this->input->post('password'), $this->input->post('remember_me')))
            {
                redirect('/');
            }
            
            $error = 'Wrong username and password combination';
        }
        
        $this->template->render('sessions/create', array('error' => $error));
    }


    public function action_destroy()
    {
        $this->auth->logout();
        redirect('/');
    }


}
