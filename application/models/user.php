<?php

class User extends CI_Model {
		
	function __construct() { 
	
		parent::__construct();
		
	}
	
	public function signup($data) {
		
		$this->load->helper('encryption_helper');
		
		$data['salt'] = get_salt();
		$data['created'] = date('m-d-Y H:i:s');		
		$data['password'] = encrypt_pw($data['password'], $data['salt']);		
		$data['profile_pic'] = "images/default.jpg";
		
		$this->mongo_db->insert('users', $data);		
		$this->session->set_userdata('user', $this->get($data['username']));		
	}
	
	public function get($username) {
		
		$u = $this->mongo_db->where(array('username'=>$username))->get('users');
		if(sizeof($u) > 0) {
			return $u;
		} else {
			return array();
		}
	}
	
	public function get_by_id($user_id) {
		
		$u = $this->mongo_db->where(array('_id'=>$user_id))->get('users');
		if(sizeof($u) > 0) {
			return $u;
		} else {
			return array();
		}
	
	}
	
	public function update($where, $data) {
		
		$this->mongo_db->where($where)->update('users', $data);
		
	}
	
	public function username_exists($username) {
	
		return ( $this->mongo_db->where(array('username' => $username))->count('users') > 0 );
	
	}
	
	public function email_exists($email) {
	
		return ( $this->mongo_db->where(array('email' => $email))->count('users') > 0 );
	
	}
	
}

?>