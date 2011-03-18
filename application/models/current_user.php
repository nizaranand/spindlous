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
			
			if (!$u = get_user_by_id($user_id)) {
                return FALSE;
            }
	
			self::$user = $u;
		}
		
		return self::$user;
	}
	
	public static function login($username, $password) {
		
		$CI =& get_instance();
		$CI->load->helper('encryption_helper');		
		
		if ($u = get_user_by_username($username)) {			
						
			if($u->password == encrypt_pw($password, $u->salt)) {
				
				$CI->session->set_userdata('user_id',$u->user_id);
				self::$user = $u;
				
				return TRUE;
			}
		}
		
		return FALSE;		
	}

	public function __clone() {
		trigger_error('Clone is not allowed.', E_USER_ERROR);
	}
	
}
?>