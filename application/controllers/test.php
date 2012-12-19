<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Test extends CI_Controller {

	function __construct()
	{ 
		parent::__construct();
	}
	
	function index() {

		$this->User_model->update(array("username" => "john"), array("profile_pic" => "images/profile_pic.jpg"));

	}
}