<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('get_salt')) {
    function get_salt() {
        $index = 'abcdefghijklmnopqrstuvwxyz1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$salt = '';
		
		for ($i = 1; $i <= 22; $i++) 
		{
			$salt = $salt . $index[rand(0,61)];
		}
		
		return $salt;
    }   
}

if ( ! function_exists('encrypt_pw')) {
    function encrypt_pw($password, $salt) {
        return substr( crypt( $password , '$2a$07$' . $salt . '$'), 28, 32);
    }   
}

if ( ! function_exists('get_email_validation_string')) {
	function get_email_validation_string() {
		$index = 'abcdefghijklmnopqrstuvwxyz1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$validation_string = '';
		
		for ($i = 1; $i <= 40; $i++) {
			$validation_string = $validation_string . $index[rand(0,61)];
		}
		return $validation_string;
	}
}

?>