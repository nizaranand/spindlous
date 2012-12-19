<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct() {	
	
        parent::__construct();
		
        $this->load->helper(array('form','url'));
        $this->load->library('form_validation');
    }
	
    public function index() {

    	if ($u = Current_User::user()) {
    		redirect('/blog');
    	} else {
    		$this->load->view('welcome_page');
    	}
        
    }
	
	public function submit() {
	
		if ($this->_submit_validate() === FALSE ) {

			$u = Current_User::user();
			
			$this->index();
			return;
		}
		
		redirect('/');
		
	}
	
	private function _submit_validate() {

        $this->form_validation->set_rules('username', 'Username',
            'trim|required|callback_authenticate');
			
        $this->form_validation->set_rules('password', 'Password',
            'trim|required');
			
        $this->form_validation->set_message('authenticate','Invalid login. Please try again.');
		
        return $this->form_validation->run();
    }

	
	function authenticate() {
	
		return Current_User::login($this->input->post('username'),
								    $this->input->post('password'));
	}
}

?>