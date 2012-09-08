<?php

class Vote extends CI_Model {
		
	function __construct() { 
	
		parent::__construct();
		
	}
	
	public function upvote($sid, $username) {
		
		$v = $this->mongo_db->where(array("sid" => $sid, "username" => $username))->limit(1)->get("votes");
		if (sizeof($v) == 1) {
			if ($v[0]["type"] == "downvote") {
				$this->mongo_db->where(array("sid" => $sid, "username" => $username))->set(array("type" => "upvote", "updated" => date('m-d-Y H:i:s')))->update("votes");
			}
		} else {
			$data["sid"] = $sid;
			$data["username"] = $username;
			$data["created"] = date('m-d-Y H:i:s');
			$data["type"] = "upvote";
			$this->mongo_db->insert('votes', $data);
		}
	}
	
	public function downvote($sid, $username) {
	
		$v = $this->mongo_db->where(array("sid" => $sid, "username" => $username))->limit(1)->get("votes");
		if (sizeof($v) == 1) {
			if ($v[0]["type"] == "upvote") {
				$this->mongo_db->where(array("sid" => $sid, "username" => $username))->set(array("type" => "downvote", "updated" => date('m-d-Y H:i:s')))->update("votes");
			}
		} else {
			$data["sid"] = $sid;
			$data["username"] = $username;
			$data["created"] = date('m-d-Y H:i:s');
			$data["type"] = "downvote";
			$this->mongo_db->insert('votes', $data);
		}
		
	}
	
	public function get_by_username($username) {
	
		return $this->mongo_db->where(array("username" => $username))->get("votes");
	
	}

}

?>