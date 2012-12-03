<?php

class Follow_model
 extends CI_Model {
	function __construct()
	{ 
		parent::__construct();
	}

	public function add_follower($data) {
		$data["created"] = time();
		$this->mongo_db->insert('follows', $data);
		$this->User_model->incr_value($data['followee'], 'followers');
		$this->User_model->incr_value($data['follower'], 'following');
	}

	public function subtract_follower($data) {
		$f = $this->mongo_db->where(array('follower' => $data['follower'], 'followee' => $data['followee']))->get('follows');

		if (sizeof($f) == 1) {
			$this->mongo_db->where(array('follower' => $data['follower'], 'followee' => $data['followee']))->delete('follows');
			$this->User_model->dec_value($data['followee'], 'followers');
			$this->User_model->dec_value($data['follower'], 'following');
		}
	}

	public function following_this_user($username) {
		if($u = Current_User::user()) {
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
	
}