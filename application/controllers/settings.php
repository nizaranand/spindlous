<?php

class Settings extends CI_Controller {

    public function __construct() {	
        
		parent::__construct();
		
    }
	
	public function index() {
	
		if($u = Current_User::user()) {		
		
			$data = array('main_content' => 'settings_account', 'user_info' => $u);
			$this->load->view('includes/template', $data);
			
		}
		else {
			
			redirect('/');
			
		}
		
	
	}
	
	public function password() {
	
		if($u = Current_User::user()) {		
		
			$data = array('main_content' => 'settings_password', 'user_info' => $u);
			$this->load->view('includes/template', $data);
			
		}
		else {
			
			redirect('/');
			
		}
	
	}
	
	public function profile() {
	
		if($u = Current_User::user()) {		
		
			$data = array('main_content' => 'settings_profile', 'user_info' => $u);
			$this->load->view('includes/template', $data);
			
		}
		else {
			
			redirect('/');
			
		}
	
	}
	
	public function submit() {
	
		if($u = Current_User::user()) {		
		
			if ( ($data['username'] = $this->input->post('username')) && ($data['email'] = $this->input->post('email')) ) {
			
				$this->User->update(array('username' => $u['username']), $data);
				redirect('settings');
				
			}
			
			
		} else {
			
			redirect('/');
			
		}
		
	
	}

}

?>