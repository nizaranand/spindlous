<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('get_salt'))
{
    function get_salt()
    {
        $index = 'abcdefghijklmnopqrstuvwxyz1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$salt = '';
		
		for ($i = 1; $i <= 22; $i++) 
		{
			$salt = $salt . $index[rand(0,61)];
		}
		
		return $salt;
    }   
}

if ( ! function_exists('encrypt'))
{
    function encrypt($user)
    {
        return substr( crypt( $user->password , '$2a$07$' . $user->salt . '$'), 28, 32);
    }   
}

?>