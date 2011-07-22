<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('get_unique_id')) {
	function get_unique_id() {
		
		$index = 'abcdefghijklmnopqrstuvwxyz1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$id = '';
		
		for($i = 1; $i <= 5; $i++) {
			$id = $id . $index[rand(0,61)];
		}
		
		$CI =& get_instance();
		
		$result = $CI->mongo_db->where(array('shortid' => $id))->count('spindlet');
		
		if($result > 0) {
			return get_unique_id();
		} else {
			return $id;
		}
		
	}
	
	function get_unique_email_id() {
		
		$index = 'abcdefghijklmnopqrstuvwxyz1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$id = '';
		
		for($i = 1;$i <= 32; $i++) {
			$id = $id . $index[rand(0,61)];
		}
		
		return $id;
	}
}