<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Saved_links extends CI_Controller {

	function __construct()
	{ 
		parent::__construct();
	}
	
	function index() {
		if($u = Current_User::user()) {
					
			$s = $this->Post_model->get(array('author' => $u['username'], 'type' => 'link'));
			$data = array('main_content' => 'links',
						  'spool' => $s);
			$this->load->view('includes/template', $data);
		}
	}
	
	function new_link() {
		$data = array('main_content' => 'new_link');
		$this->load->view('includes/template', $data);
	}
	
	function add() {
		if($u = Current_User::user()) {		
			
			$data['author'] = $u->username;
			$data['url'] = $this->input->post('url');
			$data['title'] = $this->input->post('title');
			$data['body'] = $this->input->post('body');
			$data['tags'] = array();
			
			$this->Post_model->create($data);
			redirect('/saved_links/');
			
		} else {
			
			redirect('/');
			
		}
	}

}