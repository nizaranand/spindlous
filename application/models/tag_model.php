<?php

class Tag_model extends CI_Model {
	
	public function __construct() { 
	
		parent::__construct();
		
	}
	
	public function add($data) {
		
		if (isset($data['sid']) && isset($data['name'])) {
			$this->load->helper('id_gen_helper');
			$tag_data = array(
				'sid' => get_unique_id(),
				'name' => $data['name'],
				'type' => 'tag',
				'object' => $data['sid'],
				'saved' => time(),
				'tag_type' => $this->Tag_model->determine_type($data['name']),
			);
			$this->mongo_db->insert('tags', $tag_data);

			$f = $this->Feed_model->get_by_source($data['name']);

			if (count($f) == 0) {
				$feed_data = array(
					"source" => $data['name'],
					"feed_type" => "tag",
					"objects" => array($data['sid']), 
				);
				$this->Feed_model->create($feed_data);	
			} else {
				$feed_data = array(
					"sid" => $f[0]['sid'],
					"object_id" => $data['sid'],
				);
				$this->Feed_model->add_object($feed_data);
			}

			$this->Post_model->add_tag($data);
			return TRUE;
		}
		return FALSE;
		
	}
	
	public function remove($data) {
		
		if (isset($data['name']) && isset($data['sid']) && $this->Tag_model->exists($data['name'], $data['sid'])) {
			$t = $this->mongo_db->where(array('name' => $data['name'], 'object' => $data['sid']))->delete('tags');
			$this->Post_model->remove_tag($data);
			return TRUE;
		}
		return FALSE;
		
	}
	
	public function get_by_name($name) {
		
		$t = $this->mongo_db->where(array('name' => $name))->get('tags');
		if (count($t) > 0) {
			return $t;
		} else {
			return FALSE;
		}

	}

	public function count_by_name($name) {
		$t = $this->mongo_db->where(array('name' => $name))->get('tags');
		return count($t);
	}
	
	public function exists($name, $sid) {
		
		$t = $this->mongo_db->where(array('name' => $name, 'object' => $sid))->limit(1)->get('tags');
		if (sizeof($t) == 1) {
			return TRUE;
		} else {
			return FALSE;
		}
		
	}

	public function determine_type($name) {
		$first = substr($name, 0, 1);
		switch($first) {
			case "!": $type = "image";
			break;
			case "@": $type = "user";
			break;
			case "&": $type = "object";
			default: $type = "string";
		}
		return $type;
	}
}