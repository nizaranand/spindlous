<?php
class Home extends CI_Controller {

	public function index() {
		if($u = Current_User::user()) {		
		
			$s = new Spindlet();
			$spool_data = array('username' => $u->username, 'spool_by' => 'username');
			$data = array('main_content' => 'spool',
							  'spool' => $s->spool($spool_data));
			$this->load->view('includes/template', $data);
		}
		else {
			
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