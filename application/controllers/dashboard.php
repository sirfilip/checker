<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Dashboard extends MY_Controller {
    
    
    protected function before()
    {
        $this->require_authentication();
    }


    public function action_index()
    {
    }
    
    
}
