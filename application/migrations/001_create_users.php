<?php defined('BASEPATH') OR exit('No direct script access allowed');


class Migration_Create_users extends CI_Migration {


    public function up()
    {
        $this->dbforge->add_field('id');
        $this->dbforge->add_field('username varchar(255)');
        $this->dbforge->add_field('email varchar(255)');
        $this->dbforge->add_field('hashed_password char(32)');
        $this->dbforge->add_field('roles int unsigned default 1');
        $this->dbforge->add_field('remember_me_token char(32)'); 

        $this->dbforge->create_table('users');

        $this->db->query("alter table users add unique index users_username_idx (username)");
        $this->db->query("alter table users add unique index users_email_idx (email)"); 
        $this->db->query("alter table users add unique index users_remember_me_token_idx (remember_me_token)"); 
    }

    public function down()
    {
        $this->db->query("drop index users_username_idx on users");
        $this->db->query("drop index users_email_idx on users"); 
        $this->db->query("drop index users_remember_me_token_idx on users"); 
        $this->dbforge->drop_table('users');
    }


}
