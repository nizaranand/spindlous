<?php

class Unit_test extends CI_Controller {

	function __construct()
	{ 
		parent::__construct();
	}
	
	function index() {
		
		$this->session->sess_destroy();
		$this->load->Model('Tag');
		$this->load->library('unit_test');
		$this->unit->use_strict(TRUE);
		
		$data = array("username" => "jimmy", "password" => "secret", "email" => "jimmy@gmail.com", "favorite_color" => "blue");
		$this->User->signup($data);
		$u = $this->User->get_by_username("jimmy");
		echo $this->unit->run($u['username'], 'jimmy', "User->get_by_username");
		
		$u2 = $this->User->get_by_id($u['_id']);
		echo $this->unit->run((string)$u['_id'], (string)$u2['_id'], "get_by_id");
		
		$this->User->update(array("username" => "jimmy"), array("email" => "jimmy_jones@gmail.com", "favorite_color" => "green"));
		$u3 = $this->User->get_by_username("jimmy");
		echo $this->unit->run($u3['email'], "jimmy_jones@gmail.com", "User->update");
		echo $this->unit->run($u3['favorite_color'], "green", "User->update");
		
		$u4 = $this->User->authenticate("jimmy", "secret");
		echo $this->unit->run($u4, 'is_array', "User->authenticate");
		
		$this->User->delete("jimmy");
		$u5 = $this->User->get_by_username("jimmy");
		echo $this->unit->run($u5, false, "User->delete");
		
		$this->Tag->add('Awesome!');
		$this->Tag->add('Awesome!');
		$t = $this->Tag->get_by_name('Awesome!');
		echo $this->unit->run($t['name'], 'Awesome!', "Tag->add, Tag->get_by_name");
		echo $this->unit->run($t['saved'], 2, "Tag->add increment");
		echo $this->unit->run($this->Tag->exists('Awesome!'), true, "Tag->exists");
		$this->Tag->remove('Awesome!');
		echo $this->unit->run($t['saved'], 2, "Tag->remove");
		
		$this->mongo_db->where(array('name' => 'Awesome!'))->delete('tags');
		
		$data2 = array("title" => "test title", "body" => "test body", "author" => "john", "url" => "http://www.test.com", "published" => "false");
		$this->Spindlet->create($data2);
		$s = $this->Spindlet->get(array("title" => "test title"));
		echo $this->unit->run($s[0]['author'], "john", "Spindlet->create Spindlet->get");
		
		$s2 = $this->Spindlet->get_by_sid($s[0]["sid"]);
		echo $this->unit->run($this->Spindlet->sid_exists($s2["sid"]), true, "Spindlet->get_by_sid Spindlet->sid_exists");
		
		$this->Spindlet->publish($s2["sid"]);
		$s2 = $this->Spindlet->get_by_sid($s2["sid"]);
		echo $this->unit->run($s2["published"], "true", "Spindlet->publish");
		
		$this->Spindlet->hide($s2["sid"]);
		$s2 = $this->Spindlet->get_by_sid($s2["sid"]);
		echo $this->unit->run($s2["published"], "false", "Spindlet->hide");
		
		$this->Spindlet->add_tag($s2['sid'], "#TAG!");
		$t = $this->Spindlet->get_tags($s2['sid']);
		echo $this->unit->run($t[0], "#TAG!", "Spindlet->add_tag Spindlet->get_tags");
		
		$this->Spindlet->remove_tag($s2['sid'], "#TAG!");
		$t = $this->Spindlet->get_tags($s2['sid']);
		echo $this->unit->run(sizeof($t), 0, "Spindlet->remove_tag");
		
		$this->Spindlet->update($s2['sid'], array("author" => "Crazydilly", "body" => "Body rockin in the house tooonigght"));
		$s2 = $this->Spindlet->get_by_sid($s2["sid"]);
		echo $this->unit->run($s2['author'], 'Crazydilly', "Spindlet->update");
		
		
		$this->mongo_db->where(array("title" => "test title"))->delete('spindlets');
		$this->mongo_db->where(array('url' => "http://www.test.com"))->delete('urls');

	}	
}
?>