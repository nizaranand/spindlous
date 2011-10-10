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
		$data['profile_pic'] = "images/silhoeutte.png";
		$data['full_name'] = "";
		
		$this->mongo_db->insert('users', $data);	
	}
	
	public function authenticate($username, $password) {
		
		$this->load->helper('encryption_helper');
		
		if ($u = $this->get_by_username($username)) {
			if ($u['password'] == encrypt_pw($password, $u['salt'])) {
				return $u;
			}
			return FALSE;
		}
		return FALSE;
	}
	
	public function change_password($username, $old_pw, $new_pw) {
	
		$this->load->helper('encryption_helper');
		
		if ($u = $this->get_by_username($username)) {
			if ($u['password'] == encrypt_pw($old_pw, $u['salt'])) {
				$new_pw = encrypt_pw($new_pw, $u['salt']);
				$this->update(array('username' => $username), array('password', $new_pw));
				return TRUE;
			}
			return FALSE;
		}
		return FALSE;
	
	}
	
	public function get_by_username($username) {
		
		$u = $this->mongo_db->where(array('username'=>$username))->limit(1)->get('users');
		if(sizeof($u) == 1) {
			return $u[0];
		} else {
			return FALSE;
		}
	}
	
	public function get_by_id($user_id) {
		
		$u = $this->mongo_db->where(array('_id'=>$user_id))->limit(1)->get('users');
		if(sizeof($u) == 1) {
			return $u[0];
		} else {
			return FALSE;
		}
	
	}
	
	public function update($where, $data) {
		
		$this->mongo_db->where($where)->set($data)->update('users');
		
	}
	
	public function change_pic($username, $picture) {
	
		$this->mongo_db->where(array('username' => $username))->set(array('profile_pic' => $picture))->update('users');
		$this->Spindlet->change_pic($username, $picture);
	
	}
	
	public function username_exists($username) {
	
		return ( $this->mongo_db->where(array('username' => $username))->count('users') > 0 );
	
	}
	
	public function email_exists($email) {
	
		return ( $this->mongo_db->where(array('email' => $email))->count('users') > 0 );
	
	}
	
	public function delete($username) {
		
		$this->mongo_db->where(array('username' => $username))->delete('users');
		
	}
	
	public function get_picture($username) {
	
		$u = $this->mongo_db->where(array('username' => $username))->limit(1)->get('users');
		
		return $u[0]['profile_pic'];
	
	}
	
}

?>