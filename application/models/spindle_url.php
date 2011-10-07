<?php

Class Spindle_url extends CI_Model {

	function __construct() { 
		parent::__construct();
		
	}
	
	function add($data) {
		
		if ($u = $this->get_by_url($data['url'])) {
			$this->mongo_db->where(array('url' =>$data['url']))->inc(array('saved' => 1))->update('urls');
		} else {
			$data['first_saved'] = date('m-d-Y H:i:s');
			$data['saved'] = 1;
			$this->mongo_db->insert('urls', $data);
		}
		
	}
	
	function get_by_url($url) {
		
		$u = $this->mongo_db->where(array('url' => $url))->limit(1)->get('urls');
		if(sizeof($u) == 1) {
			return $u[0];
		} else {
			return FALSE;
		}
		
	}

}