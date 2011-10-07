<?php

class Test extends CI_Controller {

	function __construct()
	{ 
		parent::__construct();
	}
	
	function index() {
		
		$this->load->Model('Tag');
		
		$this->Tag->add('Tag!');
		
		$t = $this->Tag->get('Tag!');
		
		var_dump($t);
		
	
	}	
}