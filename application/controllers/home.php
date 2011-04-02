<?php
class Home extends CI_Controller {

	public function index() {
		if($u = Current_User::user()) {		
		
			$s = new Spindlet();
			$data = array('main_content' => 'spool',
							  'spool' => $s->spool_by_user($u->username));
			$this->load->view('includes/template', $data);
		}
		else {
			
			$this->load->view('welcome_page');
			
		}
	}
	
	public function add_spindlet() {
		if($username = Current_User::user()->username) {		
			$s = new Spindlet();
			$s->create();
			$data = array('main_content' => 'spool',
						  'spool' => $s->spool_by_user($username));
			
			/*$this->load->view('includes/template', $data);*/
		} else {
			$this->load->view('welcome_page');
		}
	}
	
	public function profile($username) {
		$s = new Spindlet();
		$data = array('main_content' => 'profile',
			              'username' => $username);
		
		$this->load->view('includes/template', $data);	  
	}

}
