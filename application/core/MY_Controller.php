<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class MY_Controller extends CI_Controller {
    
    public function _remap($method, $params = array())
    {
        $action = "action_{$method}";
        
        if (method_exists($this, $action))
        {
            call_user_func_array(array($this, 'before'), array());
            return call_user_func_array(array($this, $action), $params);
        }
        else
        {
            show_404();
        }
    }
    
    protected function before() {}
    
    protected function require_authentication()
    {
       if ($this->auth->is_authenticated()) return;
       redirect('signin'); 
    }
    
}
