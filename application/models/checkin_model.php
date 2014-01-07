<?php

class Checkin_model extends MY_Model {
    
    
    protected $_table = 'checkins';
    protected $_dto = 'Checkin';
    
    private $_error = NULL;
    
    
    public function checkin_in_progress_for($user_id)
    {
        return $this->where(array('user_id' => $user_id, 'completed' => 0))->get();
    }
    
    public function checkout_history_for($user_id)
    {
        $this->where(array('user_id' => $user_id, 'completed' => 1));
        return $this;
    }
    
    public function checkin($user)
    {
        $this->_error = NULL;
        if($this->checkin_in_progress_for($user->id))
        {
            $this->_error = 'Check in is already in process.';
            return FALSE;
        }
        $this->create(array(
            'checkedin_at' => date('Y-m-d H:i:s'),
            'user_id' => $user->id,
            'completed' => 0,
        ));
        return TRUE;
    }
    
    
    public function checkout($user, $description = '')
    {
        $this->_error = NULL;
        $checkin = $this->checkin_in_progress_for($user->id); 
        if(!$checkin) 
        {
            $this->_error = 'No checkin in process';
            return FALSE;
        }
        
        $this->update($checkin->id, array(
            'checkedout_at' => date('Y-m-d H:i:s'),
            'completed' => 1,
            'description' => $description,
        ));
        return TRUE;
    }
    
    
    public function error()
    {
        return $this->_error;
    }
    
    
    
}



class Checkin {
    
    public function elapsed_time()
    {
        $now = new DateTime;
        $checkedin_at = new DateTime($this->checkedin_at);
        return $this->format_diff($now->diff($checkedin_at));
    }
    
    public function duration()
    {
        $checkedin_at = new DateTime($this->checkedin_at);
        $checkedout_at = new DateTime($this->checkedout_at);
        return $this->format_diff($checkedout_at->diff($checkedin_at));
    }
    
    public function description()
    {
        return trim($this->description) ? substr($this->description, 0, 25) : 'No description'; 
    }
    
    private function format_diff($interval) 
    {
        $result = "";
        if ($interval->y) { $result .= $interval->format("%y years "); }
        if ($interval->m) { $result .= $interval->format("%m months "); }
        if ($interval->d) { $result .= $interval->format("%d days "); }
        if ($interval->h) { $result .= $interval->format("%H hours "); }
        if ($interval->i) { $result .= $interval->format("%i minutes "); }
        $result .= $interval->format("%s seconds ");
        return $result;
    }
    
}