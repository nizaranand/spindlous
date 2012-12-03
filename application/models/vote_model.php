<?php

class Vote_model extends CI_Model {
		
	function __construct() { 
	
		parent::__construct();
		
	}
	
	public function upvote($sid, $username) {
		
		$v = $this->mongo_db->where(array("sid" => $sid, "username" => $username))->limit(1)->get("votes");
		if (sizeof($v) == 1) {
			if ($v[0]["type"] == "downvote") {
				$this->mongo_db->where(array("sid" => $sid, "username" => $username))->set(array("type" => "upvote", "updated" => date('m-d-Y H:i:s')))->update("votes");
				$this->Post_model->switch_to_upvote($sid);
				$this->User_model->switch_to_upvote($username);
			}
		} else {
			$data["sid"] = $sid;
			$data["username"] = $username;
			$data["created"] = time();
			$data["type"] = "upvote";
			$this->mongo_db->insert('votes', $data);
			$this->Post_model->upvote($sid);
			$this->User_model->upvote($username);
		}
	}
	
	public function downvote($sid, $username) {
	
		$v = $this->mongo_db->where(array("sid" => $sid, "username" => $username))->limit(1)->get("votes");
		if (sizeof($v) == 1) {
			if ($v[0]["type"] == "upvote") {
				$this->mongo_db->where(array("sid" => $sid, "username" => $username))->set(array("type" => "downvote", "updated" => date('m-d-Y H:i:s')))->update("votes");
				$this->Post_model->switch_to_downvote($sid);
				$this->User_model->switch_to_downvote($username);
			}
		} else {
			$data["sid"] = $sid;
			$data["username"] = $username;
			$data["created"] = time();
			$data["type"] = "downvote";
			$this->mongo_db->insert('votes', $data);
			$this->Post_model->downvote($sid);
			$this->User_model->downvote($username);
		}
	}
	
	public function get_by_username($args) {
		if (isset($args['limit'])) {
			if(isset($args['offset']) && isset($args['limit'])) {
				return $this->mongo_db->where(array("username" => $args['username']))->order_by(array("created" => "desc"))->offset($offset)->limit($args['limit'])->get("votes");
			} else {
				return $this->mongo_db->where(array("username" => $args['username']))->order_by(array("created" => "desc"))->limit($args['limit'])->get("votes");
			}
		} else {
			return $this->mongo_db->where(array("username" => $args['username']))->get("votes");
		}
	
	}

	public function get_count_by_username($args) {

		return $this->mongo_db->where(array("username" => $args['username']))->count("votes");
		
	}

}

?>