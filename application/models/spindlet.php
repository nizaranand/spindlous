<?php

Class Spindlet extends CI_Model {
	
	public $spool;
	
	function __construct() { 
		parent::__construct();
	}
	
	public function create($data) {
		
		$this->load->helper('id_gen_helper');
		$url_data['url'] = $data['url'];
		$url_data['username'] = $data['author'];
		$this->Spindle_Url->add($url_data);
		$data['shortid'] = get_unique_id();
		$data['created'] = date('m-d-Y H:i:s');
		$this->mongo_db->insert('spindlets', $data);
		
	}
	
	public function get($data) {
		
		return $this->mongo_db->get_where('spindlets', $data);
		
	}
	
	public function publish($id) {
		
		$this->mongo_db->where(array('_id' => $id))->update('spindlets', array('published' => 'true'));
		
	}
	
	public function hide($id) {
		
		$this->mongo_db->where(array('_id' => $id))->update('spindlets', array('published' => 'false'));
		
	}
	
	public function add_tag($id, $tag) {
		
		$this->mongo_db->where(array('shortid' => $id))->push('spindlets', array('tags' => $tag));
		
	}
	
	public function remove_tag($id, $tag) {
		
		$this->mongo_db->where(array('shortid' => $id))->pull('spindlets', array('tags' => $tag));
		
	}
	public function update($id, $data) {
		
		$this->mongo_db->where(array('_id' => $_id))->update('spindlets', $data);
		
	}
}
	