<?php  if (! defined('BASEPATH')) exit('No direct script access allowed');


class Redirector extends MY_Controller {


    public function action_index()
    {
        $this->require_authentication();
        $this->session->keep_flashdata('success');
        $this->session->keep_flashdata('danger');
        if ($this->auth->current_user()->is_admin())
        {
            redirect('admin/users');
        }
        else
        {
            redirect('dashboard');
        }
    }

}
