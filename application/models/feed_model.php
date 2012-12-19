<?php

class Feed_model extends CI_Model {

	function __construct()
	{ 
		parent::__construct();
	}
	
	public function create($data) {
	
		if (isset($data['source']) && isset($data['feed_type'])) {
			$this->load->helper('id_gen_helper');
			$data['sid'] = get_unique_id();
			$data['url'] = base_url() . 'f/' . $data['sid'];
			$data['type'] = "feed";
			if (!isset($data['objects']) || !is_array($data['objects'])) {
				$data['objects'] = array();
			}
			$url_data = array();
			$url_data['url'] = $data['url'];
			$this->Url_model->add($url_data);

			$this->mongo_db->insert('feeds', $data);

			return TRUE;
		}
		return FALSE;
		
	}

	public function add_object($data) {

		if(isset($data['sid']) && isset($data['object_id'])) {
			$objects = $this->Feed_model->get_objects($data['sid']);
			$does_not_exist = TRUE;
			if (is_array($objects) && count($objects) > 0) {
				foreach($objects as $object) {
					if ($object == $data['object_id']) $does_not_exist = FALSE;
				}
			}
			if ($does_not_exist) {
				$this->mongo_db->where(array('sid' => $data['sid']))->push('objects', $data['object_id'])->update('feeds');
				return TRUE;
			}
		}
		return FALSE;

	}
	
	public function get_by_source($source) {
	
		return $this->mongo_db->where(array('source' => $source))->get("feeds");

	}
	
	public function get_by_id($sid) {
		
		return $this->mongo_db->where(array('sid' => $sid))->get("feeds");
		
	}

	public function get_objects($sid) {

		$f = $this->mongo_db->where(array('sid' => $sid))->get("feeds");
		return $f[0]['objects'];

	}
	
	
	
	
	
}