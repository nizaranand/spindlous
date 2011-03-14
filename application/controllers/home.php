<?php
class Home extends CI_Controller {

	public function index() {
		if (Current_User::user()) {
			$data['main_content'] = 'spool';
			$this->load->view('includes/template', $data);
		} else {
			$this->load->view('login_form');
		}
	}	

}
