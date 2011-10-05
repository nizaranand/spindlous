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
			
			$u = $CI->User->get_by_id($user_id);
			
			if (!(sizeof($u) > 0)) {

                return FALSE;
            }
	
			self::$user = $u[0];
		}
		
		return self::$user;
	}
	
	public static function login($username, $password) {
		
		self::$user = null;
		
		$CI =& get_instance();
		$CI->load->helper('encryption_helper');		
		$u = $CI->User->get($username);
		
		if (sizeof($u) > 0) {			
			
			if($u[0]['password'] == encrypt_pw($password, $u[0]['salt'])) {
				
				$CI->session->set_userdata(array('user_id'=>$u[0]['_id']) );
				
				self::$user = $u[0];
				
				log_message('debug', $CI->session->userdata('user_id'));
				
				
				
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