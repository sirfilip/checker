<?php defined('BASEPATH') OR exit('No direct script access allowed');


class Migration_Create_checkins extends CI_Migration {


    public function up()
    {
        $this->dbforge->add_field('id');
        $this->dbforge->add_field('checkedin_at datetime');
        $this->dbforge->add_field('checkedout_at datetime');
        $this->dbforge->add_field('completed boolean default 0');
        $this->dbforge->add_field('user_id int unsigned');
        $this->dbforge->add_field('description text');

        $this->dbforge->create_table('checkins');

        $this->db->query('alter table checkins add index checkins_userid_completed_idx (user_id, completed)');
    }


    public function down()
    {
        $this->db->query('drop index checkins_userid_completed_idx on checkins');
        $this->dbforge->drop_table('checkins');
    }



}
