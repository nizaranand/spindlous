<?php

class Spool extends CI_Controller {

	function __construct()
	{ 
		parent::__construct();
	}
	
	function index() {
	
		if ($username = Current_user::user()->info['username']) {
		
			$s = $this->Spindlet->get(array('author' => $username));
			$data = array('main_content' => 'spool',
						  'spool' => $s);
			$this->load->view('includes/template', $data);
		} else {
			$this->load->view('welcome_page');
		}
	}


}