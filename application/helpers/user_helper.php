<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('get_user_by_id')) {

	function get_user_by_id($user_id) {
		
		$CI =& get_instance();
		
		$q = $CI->db->query("select username, password, salt from users where user_id = ? limit 1", $user_id);
		if($q->num_rows() == 1) {
			$u = New User;
			$u->username = $q->row()->username;
			$u->user_id = $user_id; 
			$u->password = $q->row()->password;
			$u->salt = $q->row()->salt;
			
			return $u;
		}
		return FALSE;	
	}
}

if ( ! function_exists('get_user_by_username')) {

	function get_user_by_username($username) {
		
		$CI =& get_instance();
		
		$q = $CI->db->query("select user_id, password, salt from users where username = ? limit 1", $username);
		if($q->num_rows() == 1) {
			$u = New User;
			$u->username = $username;
			$u->user_id = $q->row()->user_id; 
			$u->password = $q->row()->password;
			$u->salt = $q->row()->salt;
			
			return $u;
		}
		return FALSE;
	}		
}