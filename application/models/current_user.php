<?php
class Current_User {

	private static $user;

	private function __construct() {}

	public static function user() {

		if(!isset(self::$user)) {

			$CI =& get_instance();
						
			if (!($user_id = $CI->session->userdata('user_id'))) {

				return FALSE;
			}
			
			if (!($u = $CI->User->get_by_id($user_id))) {

                return FALSE;
            }
	
			self::$user = $u;
		}
		
		return self::$user;
	}
	
	public static function login($username, $password) {
		
		self::$user = null;
		
		$CI =& get_instance();
		if ($u = $CI->User->authenticate($username, $password)) {			
				
			$CI->session->set_userdata(array('user_id'=>$u['_id']) );
				
			self::$user = $u;
				
			log_message('debug', $CI->session->userdata('user_id'));
				
			return TRUE;
		}
		return FALSE;		
	}

	public function __clone() {
		trigger_error('Clone is not allowed.', E_USER_ERROR);
	}
	
}
?>