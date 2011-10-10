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
	
		$this->output->enable_profiler(TRUE);
	
		if($u = Current_User::user()) {		
		
			if ( $this->input->post('hidden') == "account" )  {
			
				$data['username'] = $this->input->post('username');
				$data['email'] = $this->input->post('email');
				$this->User->update(array('username' => $u['username']), $data);
				redirect('settings');
				
			}
			
			if ( $this->input->post('hidden') == "password" ) {
			
				$this->User->change_password($u['username'], $this->input->post('current_password'), $this->input->post('new_password'));
				redirect('settings');
			
			}
			
			if ( $this->input->post('hidden') == "profile" ) {
			
				$data['full_name'] = $this->input->post('full_name');
				$this->User->update(array('username' => $u['username']), $data);
				redirect('settings');
				
			}
			
			
			
		} else {
			
			redirect('/');
			
		}
		
	
	}

}

?>