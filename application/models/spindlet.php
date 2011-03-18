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
	
		$this->db->insert('spindlets', array('uri_id' => $uri_id,
											 'user_id' => $u->user_id,
											 'title' => $this->input->post('title'),
											 'description' => $this->input->post('description'),
											 'time_created' => date('Y-m-d H:i:s')));
	
	}
	
	public function spool_by_user($username)	{
		$sql = "select uris.url, uris.number_saved, spindlets.title, spindlets.description, spindlets.time_created
				from test.uris
				join test.spindlets on uris.uri_id = spindlets.uri_id
				join test.users on spindlets.user_id = users.user_id
				where users.username = ?";
		return $this->db->query($sql, $username);
	}	
}
	