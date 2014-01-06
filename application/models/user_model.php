<?php  if (! defined('BASEPATH')) exit('No direct script access allowed');



class User_model extends MY_Model {
    
    const SALT = 'a secret';
    
    protected $_table = 'users';
    
    
    public function has_password($user, $password)
    {
        return $user->hashed_password == $this->encrypt($password);
    }
    
    protected function encrypt($password)
    {
        return md5(static::SALT.$password);
    }
    
    
}
