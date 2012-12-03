<?php

class Email_Validation extends CI_Model {

	function __construct()
	{ 
		parent::__construct();
	}
	
	function add($data) {
		$this->load->helper('encryption_helper');
		$data['validation_string'] = get_email_validation_string();
		$this->mongo_db->insert('email_validation', $data);
	}

	function validate($email) {
		$this->mongo_db->where(array('email' => $email))->delete('email_validation');
	}

	function get_validation_string($email) {
		return $this->mongo_db_where(array('email' => $email))->get('email_validation');
	}
		
}