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

		// User_model testing:
		
		$data = array("username" => "jimmy", "password" => "secret", "email" => "jimmy@gmail.com", "favorite_color" => "blue");
		$this->User_model->signup($data);
		$data = array("username" => "crazydilly", "password" => "secret", "email" => "crazydilly@gmail.com", "favorite_color" => "blue");
		$this->User_model->signup($data);
		$u = $this->User_model->get_by_username("jimmy");
		echo $this->unit->run($u['username'], 'jimmy', "User->get_by_username");
		
		$u2 = $this->User_model->get_by_id($u['_id']);
		echo $this->unit->run((string)$u['_id'], (string)$u2['_id'], "get_by_id");
		
		$this->User_model->update(array("username" => "jimmy"), array("email" => "jimmy_jones@gmail.com", "favorite_color" => "green"));
		$u3 = $this->User_model->get_by_username("jimmy");
		echo $this->unit->run($u3['email'], "jimmy_jones@gmail.com", "User->update");
		echo $this->unit->run($u3['favorite_color'], "green", "User->update");

		$u4 = $this->User_model->email_exists("jimmy_jones@gmail.com");
		echo $this->unit->run($u4, TRUE, ">User_model->email_exists");

		$u4 = $this->User_model->email_exists("jimmy@gmail.com");
		echo $this->unit->run($u4, FALSE, ">User_model->email_exists");

		$u4 = $this->User_model->validate_email("jimmy");
		$u = $this->User_model->get_by_username("jimmy");
		echo $this->unit->run($u['validated'], TRUE, "User_model->validate_email");
		
		$u5 = $this->User_model->authenticate("jimmy", "secret");
		echo $this->unit->run($u5, 'is_array', "User->authenticate");

		$data = array("username" => "jimmy", "new_password" => "secret2", "old_password" => "secret");
		$u6 = $this->User_model->change_password($data);
		echo $this->unit->run($u6, true, "User->change_password 1");

		$u6 = $this->User_model->authenticate("jimmy", "secret2");
		echo $this->unit->run($u6, 'is_array', "User->change_password 2");

		$u7 = $this->User_model->username_exists("jimmy");
		echo $this->unit->run($u7, true, "User_model->username_exists");

		$u8 = $this->User_model->username_exists("jimASDFASDFFFFFAFAFAFAy");
		echo $this->unit->run($u8, FALSE, "User_model->username_exists 2");

		$picture = $this->User_model->get_picture("jimmy");
		echo $this->unit->run($picture, "images/silhoeutte.png", "User_model->get_picture 1");

		$data2 = array("title" => "test title", "body" => "test body", "author" => "jimmy", "url" => "http://www.test.com", "published" => "false", "type" => "link");
		$post_id = $this->Post_model->create($data2);
		$post = $this->Post_model->get_by_sid($post_id);
		echo $this->unit->run($post['profile_pic'], $picture, "Making sure the profile pic gets attached to the post");

		$u9 = $this->User_model->change_pic("jimmy", "images/silhoeutte2.png");
		echo $this->unit->run($u9, TRUE, "User_model->change_pic 1");

		$u10 = $this->User_model->get_by_username("jimmy");
		echo $this->unit->run($u10['profile_pic'], "images/silhoeutte2.png", "User_model->change_pic 2");

		$post = $this->Post_model->get_by_sid($post_id);
		echo $this->unit->run($post['profile_pic'], "images/silhoeutte2.png", "Making sure the profile pic gets attached to the post");

		$u11 = $this->User_model->incr_value("jimmy", "comments_count");
		$jimmy = $this->User_model->get_all_data("jimmy");
		echo $this->unit->run($jimmy['user_info']['comments_count'], 1, "User_model->incr_value");

		$u11 = $this->User_model->dec_value("jimmy", "comments_count");
		$jimmy = $this->User_model->get_all_data("jimmy");
		echo $this->unit->run($jimmy['user_info']['comments_count'], 0, "User_model->dec_value");

		$u11 = $this->User_model->incr_value("jimmy", "influence", VOTE_INFLUENCE_GAIN);
		$jimmy = $this->User_model->get_all_data("jimmy");
		echo $this->unit->run($jimmy['user_info']['influence'], VOTE_INFLUENCE_GAIN, "User_model->incr_value");

		$u11 = $this->User_model->dec_value("jimmy", "influence", VOTE_INFLUENCE_GAIN);
		$jimmy = $this->User_model->get_all_data("jimmy");
		echo $this->unit->run($jimmy['user_info']['influence'], 0, "User_model->dec_value");

		$u = $this->User_model->upvote("jimmy");
		$jimmy = $this->User_model->get_all_data("jimmy");
		echo $this->unit->run($jimmy['user_info']['influence'], VOTE_INFLUENCE_GAIN, "User_model->upvote");

		$u = $this->User_model->switch_to_downvote("jimmy");
		$jimmy = $this->User_model->get_all_data("jimmy");
		echo $this->unit->run($jimmy['user_info']['influence'], VOTE_INFLUENCE_GAIN - (2*VOTE_INFLUENCE_GAIN), "User_model->switch_to_downvote");

		$u = $this->User_model->downvote("jimmy");
		$jimmy = $this->User_model->get_all_data("jimmy");
		echo $this->unit->run($jimmy['user_info']['influence'], 0 - (2*VOTE_INFLUENCE_GAIN), "User_model->downvote");

		$u = $this->User_model->switch_to_upvote("jimmy");
		$jimmy = $this->User_model->get_all_data("jimmy");
		echo $this->unit->run($jimmy['user_info']['influence'], 0, "User_model->switch_to_upvote");

		//Current_User testing:

		$u = Current_User::login('john2','password');
		echo $this->unit->run($u, TRUE, "Current_User::login()");

		$u = Current_User::user();
		echo $this->unit->run($u['username'], 'john2', "Current_User::user()");

		//Follow_model testing:

		$data = array("follower" => $u['username'], "followee" => "jimmy");
		$f = $this->Follow_model->add_follower($data);
		echo $this->unit->run($f, TRUE, "Follow_model->add_follower 1");

		$data = array("follower" => "asddfdfdasdf", "followee" => "jimmy");
		$f = $this->Follow_model->add_follower($data);
		echo $this->unit->run($f, FALSE, "Follow_model->add_follower 2");

		$f = $this->User_model->get_all_data("jimmy");
		var_dump($f['followers_count']);
		echo $this->unit->run($f['followers_count'], 1, "Follow_model->add_follower 3");

		$f = $this->User_model->get_all_data("john2");
		var_dump($f['following_count']);
		echo $this->unit->run($f['following_count'], 1, "Follow_model->add_follower 4");

		$f = $this->Follow_model->following_this_user("jimmy");
		echo $this->unit->run($f, TRUE, "Follow_model->following_this_user 1 ");

		$f = $this->Follow_model->following_this_user("john");
		echo $this->unit->run($f, FALSE, "Follow_model->following_this_user 2");

		$data = array("follower" => $u['username'], "followee" => "jimmy");
		$f = $this->Follow_model->subtract_follower($data);
		$f = $this->Follow_model->following_this_user("jimmy");
		echo $this->unit->run($f, FALSE, "Follow_model->subtract_follower 1");

		$u = $this->User_model->get_all_data("jimmy");
		echo $this->unit->run($u['followers_count'], 0, "Follow_model->subtract_follower 2");

		$u = $this->User_model->get_all_data("john2");
		echo $this->unit->run($u['following_count'], 0, "Follow_model->subtract_follower 3");

		// Post_model, Feed_model, Tag_model testing:

		$data2 = array("title" => "test title123", "body" => "test body", "author" => "john", "url" => "http://www.test.com", "published" => "false", "type" => "share", "tags" => array("Awesome", "!somepic"));
		$this->Post_model->create($data2);
		$s = $this->Post_model->get(array("title" => "test title123"));
		echo $this->unit->run($s[0]['author'], "john", "Post->create Post->get");

		$t = $this->Post_model->get_tags($s[0]['sid']);
		echo $this->unit->run($t, 'is_array', "Post_model addings tags at creation");

		$data3 = array("title" => "test title2", "body" => "test body", "author" => "john", "url" => "http://www.test.com", "published" => "false", "type" => "share");
		$this->Post_model->create($data3);
		$s2 = $this->Post_model->get(array("title" => "test title2"));
		$tag_data1 = array("username" => "john", "name" => "Awesome!", "sid" => $s[0]['sid']);
		$tag_data2 = array("username" => "john", "name" => "Awesome!", "sid" => $s2[0]['sid']);
		$this->Tag_model->add($tag_data1);
		$this->Tag_model->add($tag_data2);
		$t = $this->Tag_model->get_by_name('Awesome!');
		echo $this->unit->run($this->Tag_model->exists('Awesome!', $s[0]['sid']), true, "Tag->exists");
		foreach($t as $tag) {
			echo $this->unit->run($tag['name'], 'Awesome!', "Tag->add, Tag->get_by_name");
		}
		

		$f = $this->Feed_model->get_by_source("Awesome!");
		$f2 = $this->Feed_model->get_by_id($f[0]['sid']);
		echo $this->unit->run($f[0]['source'], $f2[0]['source'], 'Feed_model->create, add_object, get_by_source, get_by_id');

		$o = $this->Feed_model->get_objects($f[0]['sid']);
		echo $this->unit->run($o, 'is_array', 'Feed_model->get_objects');

		$this->Tag_model->remove($tag_data1);
		$t = $this->Tag_model->exists($tag_data1['name'], $tag_data1['sid']);
		echo $this->unit->run($t, FALSE, "Tag->remove");
		
		$s2 = $this->Post_model->get_by_sid($s[0]["sid"]);
		echo $this->unit->run($this->Post_model->sid_exists($s2["sid"]), true, "Post->get_by_sid Post->sid_exists");
		
		$this->Post_model->publish($s2["sid"]);
		$s2 = $this->Post_model->get_by_sid($s2["sid"]);
		echo $this->unit->run($s2["published"], true, "Post->publish");
		
		$this->Post_model->hide($s2["sid"]);
		$s2 = $this->Post_model->get_by_sid($s2["sid"]);
		echo $this->unit->run($s2["published"], false, "Post->hide");
		
		$this->Tag_model->add(array("name" => "#TAG!", "sid" => $s2['sid']));
		$t = $this->Post_model->get_tags($s2['sid']);
		echo $this->unit->run(count($t), 3, "Post->add_tag Post->get_tags");
		if (count($t) > 0) {
			echo $this->unit->run($t[2], "#TAG!", "Post->add_tag Post->get_tags");
		}
		
		$this->Tag_model->remove(array("name" => "#TAG!", "sid" => $s2['sid']));
		$t = $this->Post_model->get_tags($s2['sid']);
		echo $this->unit->run(sizeof($t), 2, "Post->remove_tag");
		
		$this->Post_model->update($s2['sid'], array("author" => "crazydilly", "body" => "Body rockin in the house tooonigght"));
		$s2 = $this->Post_model->get_by_sid($s2["sid"]);
		echo $this->unit->run($s2['author'], 'crazydilly', "Post->update");

		//Vote model testing:

		$this->Vote_model->upvote($s2['sid'], "john");
		$s2 = $this->Post_model->get_by_sid($s2["sid"]);
		echo $this->unit->run($s2['upvotes_count'], 1, "Vote_model->upvote upvotes check");
		echo $this->unit->run($s2['downvotes_count'], 0, "Vote_model->upvote downvotes check");
		echo $this->unit->run($s2['influence_gain'], VOTE_INFLUENCE_GAIN, "Vote_model->upvote influence_gain");
		echo $this->unit->run($s2['vote_diff'], 1, "Vote_model->upvote vote_diff check");

		$this->Vote_model->upvote($s2['sid'], "john2");
		$this->Vote_model->upvote($s2['sid'], "john2");
		$this->Vote_model->upvote($s2['sid'], "john2");
		$this->Vote_model->upvote($s2['sid'], "john2");
		$s2 = $this->Post_model->get_by_sid($s2["sid"]);
		echo $this->unit->run($s2['upvotes_count'], 2, "Vote_model->upvote upvotes check 2");
		echo $this->unit->run($s2['downvotes_count'], 0, "Vote_model->upvote downvotes check 2");
		echo $this->unit->run($s2['influence_gain'], 2 * VOTE_INFLUENCE_GAIN, "Vote_model->upvote influence_gain 2");
		echo $this->unit->run($s2['vote_diff'], 2, "Vote_model->upvote vote_diff check 2");

		$this->Vote_model->downvote($s2['sid'], "jimmy");
		$s2 = $this->Post_model->get_by_sid($s2["sid"]);
		echo $this->unit->run($s2['upvotes_count'], 2, "Vote_model->upvote upvotes check 2");
		echo $this->unit->run($s2['downvotes_count'], 1, "Vote_model->upvote downvotes check 2");
		echo $this->unit->run($s2['influence_gain'], (2 * VOTE_INFLUENCE_GAIN) - (VOTE_INFLUENCE_GAIN), "Vote_model->upvote influence_gain 2");
		echo $this->unit->run($s2['vote_diff'], 1, "Vote_model->upvote vote_diff check 2");

		$u = $this->User_model->get_by_username("crazydilly");
		echo $this->unit->run($u['influence'], (2 * VOTE_INFLUENCE_GAIN) - (VOTE_INFLUENCE_GAIN), "Vote_model->upvote influence updated on user");

		//Reset data:

		$this->mongo_db->where(array("body" => "test body"))->delete_all('posts');
		$this->mongo_db->where(array("body" => "Body rockin in the house tooonigght"))->delete_all('posts');
		$this->mongo_db->where(array("title" => "test title2"))->delete_all('posts');
		$this->mongo_db->where(array('url' => "http://www.test.com"))->delete_all('urls');
		$this->mongo_db->where(array('name' => "Awesome!"))->delete_all('tags');
		$this->mongo_db->where(array('source' => "Awesome!"))->delete_all('feeds');
		$this->mongo_db->where(array('name' => "#TAG!"))->delete_all('tags');
		$this->mongo_db->where(array('name' => "Awesome"))->delete_all('tags');
		$this->mongo_db->where(array('name' => ""))->delete_all('tags');
		$this->mongo_db->where(array('name' => "!somepic"))->delete_all('tags');
		$this->mongo_db->where(array('followee' => "jimmy"))->delete_all('follows');
		$this->mongo_db->where(array('sid' => $s2['sid']))->delete_all('votes');
		$this->User_model->delete("jimmy");
		$this->User_model->delete("crazydilly");
		$u9 = $this->User_model->get_by_username("jimmy");
		echo $this->unit->run($u9, false, "User->delete");

	}	
}
?>