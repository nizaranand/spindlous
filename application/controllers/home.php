<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	

	public function index() {
		
		if($u = Current_User::user()){		
		
			$s = $this->Post_model->get(array('author' => $u['username']));
			$data = array('main_content' => 'spool',
							  'spool' => $s);
			$this->load->view('includes/template', $data);
			
		}
		else {
			
			$this->load->view('welcome_page');
			
		}
	}

}