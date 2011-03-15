<?php

Class Spindlet extends CI_Model {

	function __construct()
	{ 
		parent::__construct();
	}
	
	public function create() {
	
		$u = Current_User::user();
		$l = new Spindle_uri();
	
		$url = $this->input->post('url');
		$uri_id = $l->create($url);
		$user_id = $u->user_id;
		$title = $this->input->post('title');
		$description = $this->input->post('description');	
	
		$this->db->insert('spindlets', array('uri_id' => $uri_id,
											 'user_id' => $user_id,
											 'title' => $title,
											 'description' => $description));
	
	}
	
	public function spool_by_user($username)	{
		$sql = "select uris.url, spindlets.title, spindlets.description
				from test.uris
				join test.spindlets on uris.uri_id = spindlets.uri_id
				join test.users on spindlets.user_id = users.user_id
				where users.username = ?";
		return $this->db->query($sql, $username);
	}	
}
	