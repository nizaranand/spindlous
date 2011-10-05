<?php
class Home extends CI_Controller {

	public function index() {
		log_message('debug', '***********&*&*&*& yoyo');
		$u = Current_User::user();
		log_message('debug', $u['username']);
		if($u){		
		
			$s = $this->Spindlet->get(array('author' => $u->username));
			$data = array('main_content' => 'spool',
							  'spool' => $s);
			$this->load->view('includes/template', $data);
			
		}
		else {
			
			$this->load->view('welcome_page');
			
		}
	}

}