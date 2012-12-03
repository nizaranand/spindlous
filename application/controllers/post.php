<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Post extends CI_Controller {

    public function __construct() {	
        
		parent::__construct();
		
    }
	
	public function index() {
	
			redirect('/');
			
	}
	
	public function display_by_sid($sid) {
	
		$s = $this->Post_model->get(array('sid' => $sid, 'published' => 'true'));
		$c = $this->Post_model->get_comments($sid);
		if ($u = Current_User::user()) {
			$v = $this->Vote_model->get_by_username($u);
		}
		if (sizeof($c) > 0) {
			$c = new Comment_Node($s[0], $c, $v, $u);
		} else {
			$c = false;
		}
		$sh = $this->Post_model->get_shares($sid);
		
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