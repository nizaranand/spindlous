<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('get_unique_id')) {
	function get_unique_id() {
		
		$index = 'abcdefghijklmnopqrstuvwxyz1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ-_';
		$id = '';
		
		for($i = 1; $i <= 6; $i++) {
			$id = $id . $index[rand(0,63)];
		}
		
		$CI =& get_instance();
		
		if($CI->Spindlet->sid_exists($id)) {
			return get_unique_id();
		} else {
			return $id;
		}
		
	}
	
	function get_unique_email_id() {
		
		$index = 'abcdefghijklmnopqrstuvwxyz1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ-_';
		$id = '';
		
		for($i = 1;$i <= 32; $i++) {
			$id = $id . $index[rand(0,63)];
		}
		
		return $id;
	}
}