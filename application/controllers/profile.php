<?php

class Profile extends CI_Controller {

    public function __construct() {	
        
		parent::__construct();
		
    }
	
	public function index() {
	
		if($u = Current_User::user()) {		
		
			$s = $this->Spindlet->get(array('author' => $u['username'], 'published' => 'true'));
			$data = array('main_content' => 'profile',
						         'spool' => $s);
			$this->load->view('includes/template', $data);
			
		}
		else {
			
			redirect('/');
			
		}
		
	
	}

}

?>