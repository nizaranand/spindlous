<?php

class Settings extends CI_Controller {

    public function __construct() {	
        
		parent::__construct();
		
    }
	
	public function index() {
	
		if($u = Current_User::user()) {		
		
			$data = array('main_content' => 'settings_account');
			$this->load->view('includes/template', $data);
			
		}
		else {
			
			redirect('/');
			
		}
		
	
	}
	
	public function password() {
	
		if($u = Current_User::user()) {		
		
			$data = array('main_content' => 'settings_password');
			$this->load->view('includes/template', $data);
			
		}
		else {
			
			redirect('/');
			
		}
	
	}
	
	public function profile() {
	
		if($u = Current_User::user()) {		
		
			$data = array('main_content' => 'settings_profile');
			$this->load->view('includes/template', $data);
			
		}
		else {
			
			redirect('/');
			
		}
	
	}
	
	public function submit() {
	
		if($u = Current_User::user()) {		
		
			if ( ($data['username'] = $this->input->post('username')) && ($data['email'] = $this->input->post('email')) ) {
			
				$this->User->update(array('username' => $u->username), $data);
				redirect('settings');
				
			}
			
			
		} else {
			
			redirect('/');
			
		}
		
	
	}

}

?>