<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Signup extends CI_Controller {

    public function __construct() {	
        parent::__construct();
		
        $this->load->helper(array('form','url'));
        $this->load->library('form_validation');
    }
	
    public function index() {
        $data['main_content'] = 'signup_form';
		$this->load->view('includes/template', $data);
    }
	
	public function submit() {
		
		if ($this->_submit_validate() === FALSE) {
			$this->index();
			return;
		} else { 
			$this->load->view('submit_success');			
			$this->load->model('user');
			
			$u = new User();						
			$u->signup();

			$this->load->view('submit_success');
		}

	}
	
	private function _submit_validate() {
	
		$this->form_validation->set_rules('username', 'Username',
            'required|alpha_numeric|min_length[3]|max_length[12]|unique[User.username]');
 
        $this->form_validation->set_rules('password', 'Password',
            'required|min_length[6]|max_length[12]');
 
        $this->form_validation->set_rules('passconf', 'Confirm Password',
            'required|matches[password]');
 
        $this->form_validation->set_rules('email', 'E-mail',
            'required|valid_email|unique[User.email]');
 
        return $this->form_validation->run();
 
    }
}
