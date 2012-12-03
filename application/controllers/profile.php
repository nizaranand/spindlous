<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profile extends CI_Controller {

    public function __construct() {	
        
		parent::__construct();
		
    }
	
	public function index() {
	
		if($u = Current_User::user()) {

			$data = $this->User_model->get_all_data($u['username']);
			$data['main_content'] = 'self_user_profile';
			$this->load->view('includes/template', $data);

		} else {
			
			redirect('/');
			
		}
		
	}

	public function edit() {

		if($u = Current_User::user()) {

			$data = $this->User_model->get_all_data($u['username']);
			$data['main_content'] = 'edit_self_user_profile';
			$this->load->view('includes/template', $data);

		} else {
			
			redirect('/');
			
		}

	}

	public function settings() {

		if($u = Current_User::user()) {

			$data = $this->User_model->get_all_data($u['username']);
			$data['main_content'] = 'settings';
			$this->load->view('includes/template', $data);

		} else {
			
			redirect('/');
			
		}

	}

}

?>