<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Post extends CI_Controller {

    public function __construct() {	
        
		parent::__construct();
		
    }
	
	public function index() {
	
			redirect('/');
			
	}
	
	public function display_by_sid($sid) {
	
		$this->load->model("Vote");
		
		$s = $this->Spindlet->get(array('sid' => $sid, 'published' => 'true'));
		$c = $this->Spindlet->get_comments($sid);
		if ($u = Current_User::user()) {
			$v = $this->Vote->get_by_username($u['username']);
		}
		if (sizeof($c) > 0) {
			$c = new Comment_Node($s[0], $c, $v, $u);
		} else {
			$c = false;
		}
		$sh = $this->Spindlet->get_shares($sid);
		
		if (sizeof($s) == 1) {
			$data = array('main_content' => 'post',
						          'post' => $s[0],
							  'comments' => $c,
							    'shares' => $sh);
			$this->load->view('includes/template', $data);	
		} else {
		
			redirect('/');
		
		}
	
	}

	

}

?>