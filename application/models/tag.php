<?php

class Tag extends CI_Model {
	
	function __construct() { 
	
		parent::__construct();
		
	}
	
	function add($data) {
		
		if ($this->exists($data['name'])) {
			$this->mongo_db->where(array('name' => $data['name']))->inc(array('saved' => 1))->update('tags');
			if(isset($data['post_id'])) {
				$this->mongo_db->where(array('name' => $data['name']))->push(array('posts' => $data['post_id']))->update('tags');
			}
		} else {
			$tag_data = array('name' => $data['name'], 'posts' => array($data['post_id']),'saved' => 1, 'first_saved' => date('m-d-Y H:i:s'));
			$this->mongo_db->insert('tags', $tag_data);
		}
		
	}
	
	function remove($data) {
		
		if ($this->exists($name)) {
			$this->mongo_db->where(array('name' => $data['name']))->dec(array('saved' => 1))->update('tags');
			$this->mongo_db->where(array('name' => $data['name']))->pop(array('posts' => $data['post_id']))->update('tags');
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