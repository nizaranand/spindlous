<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cron extends CI_Controller {

	function __construct()
	{ 
		parent::__construct();
	}
	
	function index() {

		//Cleanup function

		//Cleanup any orphaned votes
		$v = $this->mongo_db->get("votes");
		foreach($v as $vote) {
			$object_id = $vote['sid'];
			$o = $this->mongo_db->where(array("sid" => $object_id))->get("posts");
			if (count($o) == 0) {
				$this->mongo_db->where(array("sid" => $object_id))->delete_all("votes");
			}
		}

		//Next make sure the posts influence gain / upvote & downvote numbers are correct
		$p = $this->mongo_db->get("posts");
		foreach($p as $post) {
			$v = $this->mongo_db->where(array("sid" => $post['sid']))->get("votes");
			$upvotes = 0;
			$downvotes = 0;
			$net = 0;
			$influence_gain = 0;
			foreach($v as $vote) {
				if ($vote['type'] == 'upvote') {
					$upvotes++;
					$net++;
					$influence_gain = $influence_gain + VOTE_INFLUENCE_GAIN;
				} else {
					$downvotes++;
					$net--;
					$influence_gain = $influence_gain + VOTE_INFLUENCE_GAIN;
				}
			}
			$this->mongo_db->where(array("sid" => $post['sid']))->set(array(
				"upvotes_count" => $upvotes, 
				"downvotes_count" => $downvotes,
				"influence_gain" => $influence_gain,
				"vote_diff" => $net,
			))->update("posts");
		}

		$u = $this->mongo_db->get("users");
		foreach($u as $user) {
			$p = $this->mongo_db->where(array("author" => $user['username']))->get("posts");
			$influence = 0;
			foreach($p as $post) {
				$influence = $influence + $post['influence_gain'];
			}
			$this->mongo_db->where(array("username" => $user['username']))->set(array("influence" => $influence))->update("users");
		}

	}

}