<?php

class Test extends CI_Controller {

	function __construct()
	{ 
		parent::__construct();
	}
	
	function index() {
		
		if($u = Current_User::user()) {
			
			echo $u->info['username'];
			
			$data = array('author' => 'john');
			$r = $this->mongo_db->get('spindlets');
			
			echo sizeof($r);
			
			$s = $this->Spindlet->get($data);
			
			echo sizeof($s);
		
		}
	}	
}


/*
$s = new Spindlet;
$s->get(array('author' => $u->info['username']));
foreach($s->spool as $row) {

	echo $row['author'];
	echo $row['url'];
	echo $row['title'];
	echo $row['body'];

}
*/