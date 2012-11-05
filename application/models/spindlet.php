<?php

Class Spindlet extends CI_Model {
	
	public $spool;
	
	function __construct() { 
		parent::__construct();
	}
	
	public function create($data) {
		$url_data = array();
		$this->load->helper('id_gen_helper');
		$data['sid'] = get_unique_id();

		switch($data['type']) {
			"post" :
				$url_data['url'] = base_url() . $data['sid'];
				$data['url'] = $url_data['url'];
				break;
			"comment" :
				$url_data['url'] = base_url() . $data['sid'];
				$data['url'] = $url_data['url'];
				break;
			"share" :
				$url_data['url'] = $data['url'];
				break;
			"picture" :
				$url_data['url'] = base_url() . $data['sid'];
				$data['url'] = $url_data['url'];
				break;
			default:
				$url_data['url'] = base_url() . $data['sid'];
				$data['url'] = $url_data['url'];
		}
		
		$url_data['username'] = $data['author'];
		$this->Spindle_Url->add($url_data);
		$data['profile_pic'] = $this->User->get_picture($data['author']);
		$data['created'] = time();
		$data['saves_count'] = 0;
		$data['shares_count'] = 0;
		$data['upvotes_count'] = 0;
		$data['downvotes_count'] = 0;
		$data['vote_diff'] = 0;
		$data['comments_count'] = 0;
		$this->mongo_db->insert('spindlets', $data);
	}
	
	public function get_by_sid($sid) {
		
		$s = $this->mongo_db->where(array("sid" => $sid))->limit(1)->get("spindlets");
		if (sizeof($s) == 1) {
			return $s[0];
		} else {
			return FALSE;
		}
		
	}
	
	public function get($data) {
		
		return $this->mongo_db->where($data)->order_by(array('created' => -1))->get('spindlets');
		
		
	}
	
	public function get_comments($sid) {
		
		return $this->mongo_db->where(array("root" => $sid, "type" => "comment"))->get("spindlets");
		
	}
	
	public function get_shares($sid) {
	
		return $this->mongo_db->where(array("root" => $sid, "type" => "share"))->get("spindlets");
	
	}
	
	public function sid_exists($sid) {
		
		return ( $this->mongo_db->where(array('sid' => $sid))->count('spindlets') > 0 );		
		
	}
	
	public function publish($sid) {
		
		$this->mongo_db->where(array('sid' => $sid))->set(array('published' => 'true'))->update('spindlets');
		
	}
	
	public function hide($sid) {
		
		$this->mongo_db->where(array('sid' => $sid))->set(array('published' => 'false'))->update('spindlets');
		
	}
	
	public function add_tag($sid, $tag) {
		
		$this->load->Model('Tag');
		$this->mongo_db->where(array('sid' => $sid))->push(array('tags' => $tag))->update('spindlets');
		$this->Tag->add($tag);
		
	}
	
	public function remove_tag($sid, $tag) {
		
		$this->load->Model('Tag');
		$this->mongo_db->where(array('sid' => $sid))->pull('tags', $tag)->update('spindlets');
		$this->Tag->remove($tag);
		
	}
	
	public function get_tags($sid) {
		
		$s = $this->mongo_db->where(array('sid' => $sid))->limit(1)->get('spindlets');
		if (sizeof($s) == 1) {
			return $s[0]['tags'];
		} else {
			return FALSE;
		}
		
	}

	public function get_by_tag($tag_name, $page=1, $posts_per_page=25, $sort_alg=TIMESTAMP_SORT) {
	}

	public function update($sid, $data) {
		
		$this->mongo_db->where(array('sid' => $sid))->set($data)->update('spindlets');
		
	}
	
	public function increment($sid, $field) {
	
		$this->mongo_db->where(array('sid' => $sid))->set(array($field => 1))->update('spindlets');
	
	}
	
	public function decrement($sid, $field) {
	
		$this->mongo_db->where(array('sid' => $sid))->dec(array($field => 1))->update('spindlets');
	
	}

	/************************** History fetch function **********************/

	public function get_post_history($args) {
		$this->mongo_db->where(array('author' => $args['username'], 'type' => 'post'))
	}

	public function get_comment_history($args) {
		
	}

	public function get_share_history($args) {
		
	}

	public function get_picture_history($args) {
		
	}
	
}
	