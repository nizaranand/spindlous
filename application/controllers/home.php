<?php
class Home extends CI_Controller {

	public function index() {
		
		if($u = Current_User::user()){		
		
			$s = $this->Spindlet->get(array('author' => $u['username']));
			$data = array('main_content' => 'spool',
							  'spool' => $s);
			$this->load->view('includes/template', $data);
			
		}
		else {
			
			$this->load->view('welcome_page');
			
		}
	}

}