<?php

class Tag_model extends CI_Model {
	
	function __construct() { 
	
		parent::__construct();
		
	}
	
	function add($data) {
		
		if ($this->exists($data['name'])) {
			$this->mongo_db->where(array('name' => $data['name']))->inc(array('saved' => 1))->update('tags');
			$this->Post_model->add_tag($data['sid'], $data['name']);
		} else {
			$tag_data = array('name' => $data['name'], 'posts' => array($data['sid']),'saved' => 1, 'first_saved' => time());
			$this->mongo_db->insert('tags', $tag_data);
			$this->Post_model->add_tag($data['sid'], $data['name']);
		}
		
	}
	
	function remove($data) {
		
		if ($this->exists($data['name'])) {
			$this->mongo_db->where(array('name' => $data['name']))->dec(array('saved' => -1))->update('tags');
			$this->mongo_db->where(array('name' => $data['name']))->pull('tags', $data['sid'])->update('tags');
			$this->Post_model->remove_tag($data['sid'], $data['name']);
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