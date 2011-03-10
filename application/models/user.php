<?php

class User extends CI_Model {

	public $user_id;
	public $username;
	public $password;
	public $salt;
	
	function __construct() { 
	
		parent::__construct();
		
		
	}
	
	public function signup() {
		
		$this->load->helper('encryption_helper');
		
		$username = $this->input->post('username');
		$email = $this->input->post('email');
		$password = $this->input->post('password');		
		$salt = get_salt();
		
		$password = encrypt_pw($password, $salt);
		
		$data = array('username' => $username,
				   'email' => $email,
				   'password' => $password,
				   'salt' => $salt);
		
		$this->db->insert('users', $data);
		
		$q = $this->db->query("select user_id from users where username = '".$username."'");
		$user_id = $q->row()->user_id;
		
		$this->session->set_userdata('user', $this);
		
		return $this;		
	}
		
}

?>