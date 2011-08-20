<?php

class Spool extends CI_Controller {

	function __construct()
	{ 
		parent::__construct();
	}
	
	function index() {
	
		if ($u = Current_user::user()) {
			
			$s = $this->Spindlet->get(array('author' => $u->username));
			$data = array('main_content' => 'spool',
						  'spool' => $s);
			$this->load->view('includes/template', $data);
		} else {
			$this->load->view('welcome_page');
		}
	}


}