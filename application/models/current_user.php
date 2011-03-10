<?php
class Current_User {

	private static $user;

	private function __construct() {}

	public static function user() {

		if(!isset(self::$user)) {

			$CI =& get_instance();
            $CI->load->library('session');
			
			if (!$user_id = $CI->session->userdata('user_id')) {
				return FALSE;
			}
			
			if (!$u = Doctrine::getTable('User')->find($user_id)) {
                return FALSE;
            }
	
			self::$user = $u;
		}
		
		return self::$user;
	}
	
	public static function login($username, $password) {
		
		if ($u = Doctrine::getTable('User')->findOneByUsername($username)) {
			
			$u_input = new User();
			$u_input->password = $password;
						
			if($u->password == encrypt($u_input->password)) {
				unset($u_input);
				
				$CI =& get_instance();
				$CI->load->library('session');
				$CI->session->set_userdata('user_id',$u->id);
				self::$user = $u;
				
				return true;
			}
			
			unset($u_input);
		}
		
		return false;		
	}

	public function __clone() {
		trigger_error('Clone is not allowed.', E_USER_ERROR);
	}

}
?>