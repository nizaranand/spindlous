<?php

Class Spindle_uri extends CI_Model {

	function __construct()
	{ 
		parent::__construct();
	}
	
	function create($url) {

		if ($uri_id = $this->get_by_url($url)) {			
			
			$n = $this->get_num_saved($uri_id);
			$n++;		
			
			$this->db->query('update uris set number_saved = ? where uri_id = ?', array($n, $uri_id));
			return $uri_id;
			
		} else {
					  
			$this->db->insert('uris', array('url' => $url, 'number_saved' => 1));
			return $this->get_by_url($url);
			
		}
	}
	
	function get_by_url($url) {
	
		$sql = "select uri_id from uris where url = ? limit 1";		
		$q = $this->db->query($sql, $url);
		
		if($q->num_rows() == 1) {
		
			return $q->row('uri_id');
		}						  
		return FALSE;
	
	}
	
	function get_by_id($uri_id) {	
		
		$sql = "select url from uris where uri_id = ? limit 1";		
		$q = $this->db->query($sql, $uri_id);
		
		if($q->num_rows() == 1) {
		
			return $q->row('url');
		}						  
		return FALSE;
		
	}
	
	function get_num_saved($uri_id) {
		
		$sql = "select number_saved from uris where uri_id = ? limit 1";
		$q = $this->db->query($sql, $uri_id);
		
		if($q->num_rows() == 1) {
		
			return $q->row('number_saved');
		}						  
		return FALSE;
		
	}
}