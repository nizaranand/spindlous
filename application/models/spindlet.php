<?php

Class Spindlet extends CI_Model {

	function __construct()
	{ 
		parent::__construct();
	}
	
	public function create() {
	
		$u = Current_User::user();
		$l = new Spindle_url();
	
		$url = $this->input->post('url');
		$l->create($url);
	
		$this->db->insert('spindlets', array('url' => $url,
											 'user_id' => $u->user_id,
											 'title' => $this->input->post('title'),
											 'description' => $this->input->post('description'),
											 'time_created' => date('Y-m-d H:i:s')));
	
	}
	
	public function spool($data)	{
	
		if ($data["spool_by"] == "username") {
			
			$sql = "select urls.url, urls.number_saved, spindlets.title, spindlets.description, spindlets.time_created
				from test.urls
				join test.spindlets on urls.url = spindlets.url
				join test.users on spindlets.user_id = users.user_id
				where users.username = ?";
				
			return $this->db->query($sql, $data["username"]);
		}
		
		if($data["spool_by"] == "tag") {
			
			$sql = "select uris.url, uris.number_saved, spindlets.title, spindlets.description, spindlets.time_created
				from test.uris
				join test.spindlets on uris.uri_id = spindlets.uri_id
				join test.tag_spindlet_map on spindlets.spindlet_id = tag_spindlet_map.spindlet_id
				join test.tags on tag_spindlet_map.tag_id = tags.tag_id
				where tags.tag = ?";
				
			return $this->db->query($sql, $data["tag"]);
		}
		
		
	}	
}
	