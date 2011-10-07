<?php

class Tag extends CI_Model {
	
	function __construct() { 
	
		parent::__construct();
		
	}
	
	function add($name) {
		
		if ($this->exists($name)) {
			$this->mongo_db->where(array('name' => $name))->inc(array('saved' => 1))->update('tags');
		} else {
			$data = array('name' => $name, 'saved' => 1, 'first_saved' => date('m-d-Y H:i:s'));
			$this->mongo_db->insert('tags', $data);
		}
		
	}
	
	function remove($name) {
		
		if ($this->exists($name)) {
			$this->mongo_db->where(array('name' => $name))->dec(array('saved' => 1))->update('tags');
		}
		
	}
	
	function get_by_name($name) {
		
		$t = $this->mongo_db->where(array('name' => $name))->limit(1)->get('tags');
		if (sizeof($t) == 1) {
			return $t[0];
		} else {
			return FALSE;
		}
		
	}
	
	function exists($name) {
		
		$t = $this->mongo_db->where(array('name' => $name))->limit(1)->get('tags');
		if (sizeof($t) == 1) {
			return TRUE;
		} else {
			return FALSE;
		}
		
	}

}

?>