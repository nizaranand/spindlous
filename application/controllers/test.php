<?php

class Test extends CI_Controller {

	function __construct()
	{ 
		parent::__construct();
	}
	
	function index() {
		
		
		echo Current_User::login('john','alkali');
		
		$u = Current_User::user();
		
		
		
		
		echo $u['username'];
	
	}	
}