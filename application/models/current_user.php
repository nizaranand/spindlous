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
			
			$user = new User;
			$u = $user->get($username);
			
			if (!sizeof($u) > 0) {
                return FALSE;
            }
	
			self::$user = $u[0];
		}
		
		return self::$user;
	}
	
	public static function login($username, $password) {
		
		$CI =& get_instance();
		$CI->load->helper('encryption_helper');		
		$user = new User();
		$u = $user->get($username);
		if (sizeof($u) > 0) {			
						
			if($u[0]->password == encrypt_pw($password, $u[0]->salt)) {
				
				$CI->session->set_userdata('username',$u[0]->username);
				
				self::$user = $u[0];
				
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