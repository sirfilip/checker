<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Migration_Create_checker_admin extends CI_Migration {



  public function up()
  {
    $this->load->model('user_model');
    $this->user_model->create(array(
      'username' => 'admin',
      'email' => 'admin@example.com',
      'password' => 'pass',
      'roles' => User::ADMIN_ROLE | User::PLAIN_USER_ROLE,
    ));
  }


  public function down()
  {
    $this->load->model('user_model');
    $admin = $this->user_model->where(array('roles' => User::ADMIN_ROLE | User::PLAIN_USER_ROLE))->get();
    $this->user_model->delete($admin->id);
  }


}