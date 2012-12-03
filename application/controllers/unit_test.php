<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Unit_test extends CI_Controller {

	function __construct()
	{ 
		parent::__construct();
	}
	
	function index() {
		
		$this->session->sess_destroy();
		$this->load->library('unit_test');
		$this->unit->use_strict(TRUE);
		
		$data = array("username" => "jimmy", "password" => "secret", "email" => "jimmy@gmail.com", "favorite_color" => "blue");
		$this->User_model->signup($data);
		$u = $this->User_model->get_by_username("jimmy");
		echo $this->unit->run($u['username'], 'jimmy', "User->get_by_username");
		
		$u2 = $this->User_model->get_by_id($u['_id']);
		echo $this->unit->run((string)$u['_id'], (string)$u2['_id'], "get_by_id");
		
		$this->User_model->update(array("username" => "jimmy"), array("email" => "jimmy_jones@gmail.com", "favorite_color" => "green"));
		$u3 = $this->User_model->get_by_username("jimmy");
		echo $this->unit->run($u3['email'], "jimmy_jones@gmail.com", "User->update");
		echo $this->unit->run($u3['favorite_color'], "green", "User->update");
		
		$u4 = $this->User_model->authenticate("jimmy", "secret");
		echo $this->unit->run($u4, 'is_array', "User->authenticate");
		
		$this->User_model->delete("jimmy");
		$u5 = $this->User_model->get_by_username("jimmy");
		echo $this->unit->run($u5, false, "User->delete");

		$data2 = array("title" => "test title", "body" => "test body", "author" => "john", "url" => "http://www.test.com", "published" => "false", "type" => "link");
		$this->Post_model->create($data2);
		$s = $this->Post_model->get(array("title" => "test title"));
		echo $this->unit->run($s[0]['author'], "john", "Post->create Post->get");

		$data3 = array("title" => "test title2", "body" => "test body", "author" => "john", "url" => "http://www.test.com", "published" => "false", "type" => "link");
		$this->Post_model->create($data3);
		$s2 = $this->Post_model->get(array("title" => "test title2"));
		
		$tag_data1 = array("name" => "Awesome!", "sid" => $s[0]['sid']);
		$tag_data2 = array("name" => "Awesome!", "sid" => $s2[0]['sid']);
		$this->Tag_model->add($tag_data1);
		$this->Tag_model->add($tag_data2);
		$t = $this->Tag_model->get_by_name('Awesome!');
		echo $this->unit->run($t['name'], 'Awesome!', "Tag->add, Tag->get_by_name");
		echo $this->unit->run($t['saved'], 2, "Tag->add increment");
		echo $this->unit->run($this->Tag_model->exists('Awesome!'), true, "Tag->exists");
		$this->Tag_model->remove($tag_data1);
		$t = $this->Tag_model->get_by_name('Awesome!');
		echo $this->unit->run($t['saved'], 1, "Tag->remove");
		
		$s2 = $this->Post_model->get_by_sid($s[0]["sid"]);
		echo $this->unit->run($this->Post_model->sid_exists($s2["sid"]), true, "Post->get_by_sid Post->sid_exists");
		
		$this->Post_model->publish($s2["sid"]);
		$s2 = $this->Post_model->get_by_sid($s2["sid"]);
		echo $this->unit->run($s2["published"], "true", "Post->publish");
		
		$this->Post_model->hide($s2["sid"]);
		$s2 = $this->Post_model->get_by_sid($s2["sid"]);
		echo $this->unit->run($s2["published"], "false", "Post->hide");
		
		$this->Tag_model->add(array("name" => "#TAG!", "sid" => $s2['sid']));
		$t = $this->Post_model->get_tags($s2['sid']);
		echo $this->unit->run(count($t), 1, "Post->add_tag Post->get_tags");
		if (count($t) > 0) {
			echo $this->unit->run($t[0], "#TAG!", "Post->add_tag Post->get_tags");
		}
		
		$this->Tag_model->remove(array("name" => "#TAG!", "sid" => $s2['sid']));
		$t = $this->Post_model->get_tags($s2['sid']);
		echo $this->unit->run(sizeof($t), 0, "Post->remove_tag");
		
		$this->Post_model->update($s2['sid'], array("author" => "Crazydilly", "body" => "Body rockin in the house tooonigght"));
		$s2 = $this->Post_model->get_by_sid($s2["sid"]);
		echo $this->unit->run($s2['author'], 'Crazydilly', "Post->update");
		
		
		$this->mongo_db->where(array("body" => "test body"))->delete('posts');
		$this->mongo_db->where(array("title" => "test title2"))->delete('posts');
		$this->mongo_db->where(array('url' => "http://www.test.com"))->delete('urls');
		$this->mongo_db->where(array('name' => "Awesome!"))->delete('tags');

	}	
}
?>