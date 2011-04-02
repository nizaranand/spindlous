<?php

class Saved_links extends CI_Controller {

	function __construct()
	{ 
		parent::__construct();
	}
	
	function index() {
		if($username = Current_User::user()->username) {		
			$s = new Spindlet();
			$data = array('main_content' => 'links',
							  'spool' => $s->spool_by_user($username));
			$this->load->view('includes/template', $data);
		}
	}
	
	function new_link() {
		$data = array('main_content' => 'new_link');
		$this->load->view('includes/template', $data);
	}
	
	function add() {
		if($u = Current_User::user()) {		
			$s = new Spindlet();
			$s->create();
			$data = array('main_content' => 'links',
						  'spool' => $s->spool_by_user($u->username));
			
			$this->load->view('includes/template', $data);
		} else {
			$this->load->view('welcome_page');
		}
	}

}