<?php

class Post extends CI_Controller {

    public function __construct() {	
        
		parent::__construct();
		
    }
	
	public function index() {
	
			redirect('/');
			
	}
	
	public function display_by_sid($sid) {
	
		$s = $this->Spindlet->get(array('sid' => $sid, 'published' => 'true'));
		
		echo "hello";
		
		if (sizeof($s) == 1) {
			$data = array('main_content'  => 'post',
						          'post'  => $s[0]);
			$this->load->view('includes/template', $data);	
		} else {
		
			redirect('/');
		
		}
	
	}

}

?>