<?php
class Home extends CI_Controller {

	public function index() {
		if ($u = Current_User::user()) {
			$data['main_content'] = 'spool';
			$this->spool($u->username);
			
		} else {
			$this->load->view('login_form');
		}
	}
	
	public function add_spindlet() {
		$username = Current_User::user()->username;		
		$s = new Spindlet();
		$s->create();
		$data = array('main_content' => 'spool',
					  'spool' => $s->spool_by_user($username));
		
		$this->load->view('includes/template', $data);
	}
	
	public function spool($username) {
	
		$s = new Spindlet();
		$data = array('main_content' => 'spool',
					  'spool' => $s->spool_by_user($username));
				
		$this->load->view('includes/template', $data);
	
	}

}
