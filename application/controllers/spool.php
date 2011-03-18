<?php

class Spool extends CI_Controller {

	function __construct()
	{ 
		parent::__construct();
	}
	
	function index() {
	
		if ($username = Current_user::user()->username) {
			$s = new Spindlet;
			$data = array('main_content' => 'spool',
						  'spool' => $s->spool_by_user($username));
			$this->load->view('includes/template', $data);
		} else {
			$this->load->view('welcome_page');
		}
	}


}