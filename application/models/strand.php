<?php

Class Strand extends CI_Model {

	function __construct()
	{ 
		parent::__construct();
	}
	
	function create() {
	
		$u = CurrentUser::user();
	
		$data1 = array('url' => $this->input->post('url'));
					  
		$data2 = array('user_id' => $u->user_id,
					   'title' => $this->input->post('title'),
					   'description' => $this->input->post('description'));

		if (if data2['strand_id'] = $this->get_by_url($data1['url']) {
			
			$this->db->insert('user_strands, $data2');
			
		} else {
					  
			$this->db->insert('strands', $data1);		
			$data2['strand_id'] = $this->get_by_url($data1['url']);
			$this->db->insert('user_strands, $data2');
		}
	}
	
	function get_by_url($url) {
	
		$sql = "select (url, title, description) from strands where url = ? limit 1";		
		$q = $this->db->query($sql, $url);
		
		if($q->num_rows() == 1) {
		
			return $q->row()['strand_id'];
		}						  
		return FALSE;
	
	}
	
	function get_by_id($strand_id) {	
		
		$sql = "select (url, title, description) from strands where strand_id = ? limit 1";		
		$q = $this->db->query($sql, $strand_id);
		
		if($q->num_rows() == 1) {
		
			return array('url' => $q->row('url'),
		                 'title' => $q->row('title'),
					     'description' => $q->row('description'));
		}						  
		return FALSE;
		
	}
	
	function get_by_user($user) {
	
	}
	
	
	
	
	
}