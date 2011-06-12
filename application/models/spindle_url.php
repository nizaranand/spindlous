<?php

Class Spindle_url extends CI_Model {

	function __construct()
	{ 
		parent::__construct();
	}
	
	function create($url) {

		if ($this->exists($url)) {			
			
			$n = $this->get_num_saved($url) + 1;		
			
			$this->db->query('update urls set number_saved = ? where url = ?', array($n, $url));
			
		} else {
					  
			$this->db->insert('urls', array('url' => $url, 'number_saved' => 1));
			
		}
	}
	
	function exists($url) {
	
		$sql = "select url from urls where url = ? limit 1";		
		$q = $this->db->query($sql, $url);
		
		if($q->num_rows() == 1) {		
			return true;
		}						  
		return FALSE;
	
	}
	
	function get_num_saved($url) {
		
		$sql = "select number_saved from urls where url = ? limit 1";
		$q = $this->db->query($sql, $url);
		
		if($q->num_rows() == 1) {		
			return $q->row('number_saved');
		}						  
		return FALSE;
		
	}
}