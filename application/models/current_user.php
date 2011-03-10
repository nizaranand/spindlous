<?php
class Current_User {

	private static $user;

	private function __construct() {}

	public static function user() {

		if(!isset(self::$user)) {

			$CI =& get_instance();
			
			if (!$user_id = $CI->session->userdata('user_id')) {
				return FALSE;
			}
			
			$q = $CI->db->query('select user_id from users where user_id = "'.$user_id.'" limit = 1');
			
			if (!$u = get_user($user_id)) {
                return FALSE;
            }
	
			self::$user = $u;
		}
		
		return self::$user;
	}
	
	public static function login($username, $password) {
		
		$CI =& get_instance();
		$CI->load->helper('encryption_helper');
		
		$q = $CI->db->query("select user_id, password, salt from users where username = '".$username."' limit 1");
		
		if ($q->num_rows() == 1) {			
						
			if($q->row()->password == encrypt_pw($password, $q->row()->salt)) {
				
				$u = new User();
				$u->user_id = $q->row()->user_id;
				$u->username = $username;
				
				
				$CI->session->set_userdata('user',$u);
				self::$user = $u;
				
				return true;
			}
		}
		
		return false;		
	}
	
	public static function get_user($user_id) {
	
		$CI =& get_instance();
	
		$q = $CI->db->query('select username from users where user_id = "'.$user_id.'" limit = 1');
		if($q->num_rows() == 1) {
			$u = New User;
			$u->username = $q->row()->username;
			$u->user_id = $user_id; 
			
			return $u;
		}
		return FALSE;	
	}

	public function __clone() {
		trigger_error('Clone is not allowed.', E_USER_ERROR);
	}

}
?>