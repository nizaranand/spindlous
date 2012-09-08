<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller {

    public function __construct() {	
        
		parent::__construct();
		
    }
	
	public function index() {
		$data = array();
		if (!($data['page'] = $this->input->get('page'))) {
			$data['page'] = 1;
		}
		if (!($data['filter'] = $this->input->get('filter'))) {
			$data['filter'] = 'week';
		}
		if (!($data['tab'] = $this->input->get('tab'))) {
			$data['tab'] = 'influence';
		}
		if (!($data['search'] = $this->input->get('search'))) {
			$data['search'] = '';
		}

		$this->load->helper('pagination_helper');
		$data['num_users'] = $this->User->get_total($data);
		$data['users'] = $this->User->get_list($data);
		$data['pagination_pages'] = get_pagination_buttons($data['page'], $this->User->get_pages_amount($data), $data);
		$data['main_content'] = 'users';
		$this->load->view('includes/template', $data);
	}
	
	public function display_by_user_id() {
		
	}

}