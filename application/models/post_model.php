<?php

class Post_model extends CI_Model {
	
	public $spool;
	
	function __construct() { 
		parent::__construct();
	}
	
	public function create($data) {
		$url_data = array();
		$this->load->helper('id_gen_helper');
		$data['sid'] = get_unique_id();

		switch($data['type']) {
			case "post" :
				$url_data['url'] = base_url() . 'p/' . $data['sid'];
				$data['url'] = $url_data['url'];
				break;
			case "comment" :
				$url_data['url'] = base_url() . 'c/' . $data['sid'];
				$data['url'] = $url_data['url'];
				break;
			case "share" :
				$url_data['url'] = $data['url'];
				break;
			case "picture" :
				$url_data['url'] = base_url() . 'i/' . $data['sid'];
				$data['url'] = $url_data['url'];
				break;
			case "link" : 
			    $url_data['url'] = $data['url'];
			    break;
			default:
				$url_data['url'] = base_url() . $data['sid'];
				$data['url'] = $url_data['url'];
		}
		
		$url_data['username'] = $data['author'];
		$this->Url_model->add($url_data);
		$data['profile_pic'] = $this->User_model->get_picture($data['author']);
		$data['created'] = time();
		$data['saves_count'] = 0;
		$data['shares_count'] = 0;
		$data['upvotes_count'] = 0;
		$data['downvotes_count'] = 0;
		$data['influence_gain'] = 0;
		$data['vote_diff'] = 0;
		$data['comments_count'] = 0;
		$data['tags'] = [];
		$this->mongo_db->insert('posts', $data);
		return $data['sid'];
	}
	
	public function get_by_sid($sid) {
		
		$s = $this->mongo_db->where(array("sid" => $sid))->limit(1)->get("posts");
		if (sizeof($s) == 1) {
			return $s[0];
		} else {
			return FALSE;
		}
		
	}
	
	public function get($data) {
		
		return $this->mongo_db->where($data)->order_by(array('created' => -1))->get('posts');
		
		
	}
	
	public function get_comments($sid) {
		
		return $this->mongo_db->where(array("root" => $sid, "type" => "comment"))->get("posts");
		
	}
	
	public function get_shares($sid) {
	
		return $this->mongo_db->where(array("root" => $sid, "type" => "share"))->get("posts");
	
	}
	
	public function sid_exists($sid) {
		
		return ( $this->mongo_db->where(array('sid' => $sid))->count('posts') > 0 );		
		
	}
	
	public function publish($sid) {
		
		$this->mongo_db->where(array('sid' => $sid))->set(array('published' => 'true'))->update('posts');
		
	}
	
	public function hide($sid) {
		
		$this->mongo_db->where(array('sid' => $sid))->set(array('published' => 'false'))->update('posts');
		
	}

	public function add_tag($sid, $tag) {

		$this->mongo_db->where(array('sid' => $sid))->push('tags', $tag)->update('posts');

	}
	
	public function remove_tag($sid, $tag) {
		
		$this->mongo_db->where(array('sid' => $sid))->pull('tags', $tag)->update('posts');
		
	}
	
	public function get_tags($sid) {
		
		$s = $this->mongo_db->where(array('sid' => $sid))->limit(1)->get('posts');
		if (sizeof($s) == 1) {
			return $s[0]['tags'];
		} else {
			return FALSE;
		}
		
	}

	public function get_by_tag($tag_name, $page=1, $posts_per_page=25, $sort_alg=TIMESTAMP_SORT) {

	}

	public function update($sid, $data) {
		
		$this->mongo_db->where(array('sid' => $sid))->set($data)->update('posts');
		
	}
	
	public function increment($sid, $field) {
	
		$this->mongo_db->where(array('sid' => $sid))->inc($field)->update('posts');
	
	}
	
	public function decrement($sid, $field) {
	
		$this->mongo_db->where(array('sid' => $sid))->dec($field)->update('posts');
	
	}

	public function upvote($sid) {
		if ($s = get_by_sid($sid)) {
			$influence = $s[0]['influence_gain'];
			$upvotes = $s[0]['upvotes_count'];
			$downvotes = $s[0]['downvotes_count'];
			$upvotes++;
			$influence = $influence + 10;
			$vote_diff = $upvotes - $downvotes;
			$this->mongo_db->where(array('sid' => $sid))->set(array('influence_gain' => $influence, 'upvotes_count' => $upvotes, 'vote_diff' => $vote_diff))->update('posts');
		}
	}

	public function downvote($sid) {
		if ($s = get_by_sid($sid)) {
			$influence = $s[0]['influence_gain'];
			$upvotes = $s[0]['upvotes_count'];
			$downvotes = $s[0]['downvotes_count'];
			$downvotes++;
			$influence = $influence - 10;
			$vote_diff = $upvotes - $downvotes;
			$this->mongo_db->where(array('sid' => $sid))->set(array('influence_gain' => $influence, 'downvotes_count' => $downvotes, 'vote_diff' => $vote_diff))->update('posts');
		}
	}

	public function switch_to_upvote($sid) {
		if ($s = get_by_sid($sid)) {
			$influence = $s[0]['influence_gain'];
			$upvotes = $s[0]['upvotes_count'];
			$downvotes = $s[0]['downvotes_count'];
			$downvotes--;
			$upvotes++;
			$influence = $influence + 20;
			$vote_diff = $upvotes - $downvotes;
			$this->mongo_db->where(array('sid' => $sid))->set(array('influence_gain' => $influence, 'upvotes_count' => $upvotes, 'vote_diff' => $vote_diff))->update('posts');
		}
	}

	public function switch_to_downvote($sid) {
		if ($s = get_by_sid($sid)) {
			$influence = $s[0]['influence_gain'];
			$upvotes = $s[0]['upvotes_count'];
			$downvotes = $s[0]['downvotes_count'];
			$downvotes++;
			$upvotes--;
			$influence = $influence - 20;
			$vote_diff = $upvotes - $downvotes;
			$this->mongo_db->where(array('sid' => $sid))->set(array('influence_gain' => $influence, 'downvotes_count' => $downvotes, 'vote_diff' => $vote_diff))->update('posts');
		}
	}

	public function change_pic($username, $new_pic) {
		$this->mongo_db->where(array('author' => $username))->set(array("profile_pic" => $new_pic))->update_all('posts');
	}

	/************************** History fetch function **********************/

	public function get_post_history($args) {
		if (isset($args['limit'])) {
			if(isset($args['offset']) && isset($args['limit'])) {
				return $this->mongo_db->where(array('author' => $args['username'], 'type' => $args['type']))->order_by(array('created' => 'desc'))->limit($args['limit'])->offset($args['offset'])->get('posts');
			} else {
				return $this->mongo_db->where(array('author' => $args['username'], 'type' => $args['type']))->order_by(array('created' => 'desc'))->limit($args['limit'])->get('posts');
			} 
		} else {
			return $this->mongo_db->where(array('author' => $args['username'], 'type' => $args['type']))->order_by(array('created' => 'desc'))->get('posts');
		}
		
	}

	public function get_influence_history($args) {
		if (isset($args['limit'])) {
			if(isset($args['offset']) && isset($args['limit'])) {
				return $this->mongo_db->where(array('author' => $args['username'], 'influence_gain' => array('$ne' => 0)))->order_by(array('created' => 'desc'))->limit($args['limit'])->offset($args['offset'])->get('posts');
			} else {
				return $this->mongo_db->where(array('author' => $args['username'], 'influence_gain' => array('$ne' => 0)))->order_by(array('created' => 'desc'))->limit($args['limit'])->get('posts');
			} 
		} else {
			return $this->mongo_db->where(array('author' => $args['username'], 'influence_gain' => array('$ne' => 0)))->order_by(array('created' => 'desc'))->get('posts');
		}
	}

	public function get_post_count($args) {
		return $this->mongo_db->where(array('author' => $args['username'], 'type' => $args['type']))->count('posts');
	}

}