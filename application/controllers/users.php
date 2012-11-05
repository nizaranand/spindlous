<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller {

    public function __construct() {	
        
		parent::__construct();
		
    }
	
	public function index() {
		$args = array();
		if (!($args['page'] = $this->input->get('page'))) {
			$args['page'] = 1;
		}
		// if (!($args['filter'] = $this->input->get('filter'))) {
		// 	$args['filter'] = 'week';
		// }
		if (!($args['tab'] = $this->input->get('tab'))) {
			$args['tab'] = 'influence';
		}
		if (!($args['search'] = $this->input->get('search'))) {
			$args['search'] = '';
		}

		$this->load->helper('pagination_helper');
		$data = array();
		$data['args'] = $args;
		$data['users'] = $this->User->get_list($args);
		$data['pagination_pages'] = get_pagination_buttons($args);
		$data['main_content'] = 'users';
		$this->load->view('includes/template', $data);
	}
	
	public function display_by_username($username) {
		$data = array();
		$data['username'] = $username;
		$data['main_content'] = 'user_profile';
		$this->load->view('includes/template', $data);
	}

}