<?php

Class Spindle_url extends CI_Model {

	function __construct() { 
		parent::__construct();
		
	}
	
	function add($data) {
		
		$u = $this->mongo_db->get_where('urls', array('url' => $data['url']));
		if (sizeof($u) > 0) {
			$this->mongo_db->update('urls', array('saved' => $u[0]->saved + 1));
		} else {
			$data['first_saved'] = date('m-d-Y H:i:s');
			$data['saved'] = 1;
			$this->mongo_db->insert('urls', $data);
		}
		
	}
	
	function get($data) {
		
		$u = $this->mongo_db->get_where('urls', $data);
		if(sizeof($u) > 0) {
			return $u[0];
		} else {
			return FALSE;
		}
		
	}

}