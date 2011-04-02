<?php

class Profile extends CI_Controller {

    public function __construct() {	
        
		parent::__construct();
		
    }
	
	public function index() {
	
		if($u = Current::user()) {
			
			//$data = array('main_content' => 'profile',
			
		}
		
	
	}
	



	/*
		if($u = Current_User::user()) {
			$s = new Spindlet();
			$data = array('main_content' => 'profile',
						  'spool' => $s->spool_by_user($u->username));
			$this->load->view('includes/template', $data);
		} else {
			$this->load->view('welcome_page');
		}
	}
	
	public function display_by_username($username) {
		
		if ($u = get_user_by_username($username)) {
			$s = new Spindlet();
			$data = array('main_content' => 'profile',
						  'spool' => $s->spool_by_user($username));
			$this->load->view('includes/template', $data);
		}
	}
	
   */
}

?>