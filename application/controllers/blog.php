<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Blog extends CI_Controller {

    public function __construct() {	
        
		parent::__construct();
		
    }
	
	public function index() {
	
		if($u = Current_User::user()) {		
		
			$s = $this->Post_model->get(array('author' => $u['username'], 'published' => 'true'));
			$data = array('main_content'  => 'blog',
						         'spool'  => $s,
								 'type'   => 'self');
			$this->load->view('includes/template', $data);
			
		}
		else {
			
			redirect('/');
			
		}
		
	
	}
	
	public function display_by_username($username) {
	
		$s = $this->Post_model->get(array('author' => $username, 'published' => 'true'));
			$data = array('main_content'  => 'blog',
						         'spool'  => $s,
								 'type'   => 'other');
		$this->load->view('includes/tempalte', $data);
	
	
	}

}

?>