<?php

class Tag extends CI_Controller {

    public function __construct() {	
        
		parent::__construct();
		
    }
	
	public function index() {
	
			redirect('/');
			
	}
	
	public function display($name) {
		$s = $this->Post_model->get(array('sid' => $sid, 'published' => 'true'));

		if (sizeof($t) == 1) {
			$data = array('main_content' => 'post',
						          'post' => $t[0],
						 )
			$this->load->view('includes/template', $data);	
		} else {
		
			redirect('/');
		
		}
	}

}