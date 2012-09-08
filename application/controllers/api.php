<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Api extends CI_Controller {

    public function __construct() {	
        
		parent::__construct();
		
		
    }
	
	public function index() {
	
		$this->load->view("welcome_page");
	
	}
	
	public function test() {
	
		header('Access-Control-Allow-Origin: *');
		
		$username = $this->input->post('username'); 
		$password = $this->input->post('password'); 
		
		print $password;
		print $username;	

	}
	
	public function test2() {
		
		$this->load->view("ajax_test");
		
	}
	
}
?>