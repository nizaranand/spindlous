<?php
class Current_User {

	private static $user;

	private function __construct() {}

	public static function user() {

		if(!isset(self::$user)) {

			$CI =& get_instance();
			
			if (!$username = $CI->session->userdata('username')) {
				return FALSE;
			}
			
			$u = new User();
			
			if (!$u->get($username)) {
                return FALSE;
            }
	
			self::$user = $u;
		}
		
		return self::$user;
	}
	
	public static function login($username, $password) {
		
		$CI =& get_instance();
		$CI->load->helper('encryption_helper');		
		$u = new User();
		if ($u->get($username)) {			
						
			if($u->info['password'] == encrypt_pw($password, $u->info['salt'])) {
				
				$CI->session->set_userdata('username',$u->info['username']);
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