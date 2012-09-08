<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Debug extends CI_Controller {

	function __construct()
	{ 
		parent::__construct();
	}
	
	function index() {
		echo "Sup G";	
	}
}