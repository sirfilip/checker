<?php  if (! defined('BASEPATH')) exit('No direct script access allowed');



class User_model extends MY_Model {
    
    const SALT = 'a secret';
    
    protected $_table = 'users';
    protected $_dto = 'User';
    
    
    public function has_password($user, $password)
    {
        return $user->hashed_password == $this->encrypt($password);
    }

    public function plain_users()
    {
        $this->where('roles', 1);
        return $this;
    }
    
    protected function encrypt($password)
    {
        return md5(static::SALT.$password);
    }
    
    public function create($props) 
    {
        $props['hashed_password'] = $this->encrypt($props['password']);
        unset($props['password']);
        return parent::create($props);
    }
    
    
}


class User {

    const PLAIN_USER_ROLE = 1;
    const ADMIN_ROLE = 2;

    public function has_role($role)
    {
        return ($this->roles & $role) == $role;
    }

    public function is_admin()
    {
        return $this->has_role(static::ADMIN_ROLE);
    }
}
