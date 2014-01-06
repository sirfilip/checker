<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Template {
    
    protected $template = 'template';
    protected $vars = array();
    
    public function __construct($config = array())
    {
        $this->set_title('Checker');
    }
    
    public function set_title($title)
    {
        $this->set_var('template_title', $title);
    }
    
    
    public function set_var($prop, $val)
    {
        $this->vars[$prop] = $val;
        return $this;
    }
    
    public function set_vars($vars)
    {
        foreach ($vars as $prop => $val)
        {
            $this->set_var($prop, $val);
        }
        
        return $this;
    }
    
    public function set_template($template) 
    {
        $this->template = $template;
    }
    
    public function render($view, $vars = array())
    {
        $this->set_vars($vars);
        $this->vars['template_content'] = get_instance()->load->view($view, $this->vars, TRUE);
        get_instance()->load->view($this->template, $this->vars);
    }
    
    
}
