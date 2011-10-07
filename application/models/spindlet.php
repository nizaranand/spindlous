<?php

Class Spindlet extends CI_Model {
	
	public $spool;
	
	function __construct() { 
		parent::__construct();
	}
	
	public function create($data) {
		
		$this->load->helper('id_gen_helper');
		$data['sid'] = get_unique_id();
		if ( $data['url'] == '' ) {
			$url_data['url'] = base_url() . $data['shortid'];
			$data['url'] = $url_data['url'];
		} else {
			$url_data['url'] = $data['url'];
		}
		$url_data['username'] = $data['author'];
		$this->Spindle_Url->add($url_data);
		$data['created'] = date('m-d-Y H:i:s');
		$this->mongo_db->insert('spindlets', $data);
	}
	
	public function get_by_sid($sid) {
		
		$s = $this->mongo_db->where(array("sid" => $sid))->limit(1)->get("spindlets");
		if (sizeof($s) == 1) {
			return $s[0];
		} else {
			return FALSE;
		}
		
	}
	
	public function get($data) {
		
		return $this->mongo_db->get_where('spindlets', $data);
		
	}
	
	public function sid_exists($sid) {
		
		return ( $this->mongo_db->where(array('sid' => $sid))->count('spindlets') > 0 );		
		
	}
	
	public function publish($sid) {
		
		$this->mongo_db->where(array('sid' => $sid))->set(array('published' => 'true'))->update('spindlets');
		
	}
	
	public function hide($sid) {
		
		$this->mongo_db->where(array('sid' => $sid))->set(array('published' => 'false'))->update('spindlets');
		
	}
	
	public function add_tag($sid, $tag) {
		
		$this->load->Model('Tag');
		$this->mongo_db->where(array('sid' => $sid))->push(array('tags' => $tag))->update('spindlets');
		$this->Tag->add($tag);
		
	}
	
	public function remove_tag($sid, $tag) {
		
		$this->load->Model('Tag');
		$this->mongo_db->where(array('sid' => $sid))->pull('tags', $tag)->update('spindlets');
		$this->Tag->remove($tag);
		
	}
	
	public function get_tags($sid) {
		
		$s = $this->mongo_db->where(array('sid' => $sid))->limit(1)->get('spindlets');
		if (sizeof($s) == 1) {
			return $s[0]['tags'];
		} else {
			return FALSE;
		}
		
	}
	public function update($sid, $data) {
		
		$this->mongo_db->where(array('sid' => $sid))->set($data)->update('spindlets');
		
	}
}
	