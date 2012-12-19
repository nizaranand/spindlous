<?php

class Follow_model
 extends CI_Model {
	function __construct()
	{ 
		parent::__construct();
	}

	public function add_follower($data) {
		if ( 
			isset($data['follower']) &&
			isset($data['followee']) &&
			$this->User_model->username_exists($data['follower']) &&
			$this->User_model->username_exists($data['followee']) 
	    ) {
			$data["created"] = time();
			$this->mongo_db->insert('follows', $data);
			return TRUE;
		}
		return FALSE;
	}

	public function subtract_follower($data) {
		if ( 
			isset($data['follower']) &&
			isset($data['followee']) &&
			$this->User_model->username_exists($data['follower']) &&
			$this->User_model->username_exists($data['followee']) 
	    ) {
			$f = $this->mongo_db->where(array('follower' => $data['follower'], 'followee' => $data['followee']))->get('follows');
			if (sizeof($f) == 1) {
				$this->mongo_db->where(array('follower' => $data['follower'], 'followee' => $data['followee']))->delete('follows');
				return TRUE;
			}
		}
		return FALSE;
	}

	public function following_this_user($username) {
		if(($u = Current_User::user()) && $this->User_model->username_exists($username)) {
			$f = $this->mongo_db->where(array('follower' => $u['username'], 'followee' => $username))->limit(1)->get('follows');
			if (sizeof($f) == 1) {
				return TRUE;
			} else {
				return FALSE;
			}
		} else {
			return NULL;
		}
	}

	public function followers_count($username) {
		if ($this->User_model->username_exists($username)) {
			$f = $this->mongo_db->where(array('followee' => $username))->get('follows');
			return count($f);
		}
		return FALSE;
	}

	public function following_count($username) {
		if ($this->User_model->username_exists($username)) {
			$f = $this->mongo_db->where(array('follower' => $username))->get('follows');
			return count($f);	
		}
		return FALSE;
	}
	
}