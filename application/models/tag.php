<?php

class Tag extends CI_Model {
	
	function __construct() { 
	
		parent::__construct();
		
	}
	
	function add($data) {
		
		$t = $this->mongo_db->get_where('tags', array('name' => $data['name']));
		if (sizeof($t) == 1) {
			$this->mongo_db->update('tags', array('saved' => $t[0]['saved'] + 1));
		} else {
			$data['first_saved'] = date('m-d-Y H:i:s');
			$this->mongo_db->insert('tags', $data);
		}
		
	}
	
	function get($data) {
		
		return $this->mongo_db->get_where('tags', $data);
		
	}

}

?>