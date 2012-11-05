<?php

class User extends CI_Model {
		
	protected $USERS_PER_PAGE = 40;

	function __construct() { 

		parent::__construct();

	}
	
	public function signup($data) {
		
		$this->load->helper('encryption_helper');
		$this->load->helper('email_helper');
		
		$data['salt'] = get_salt();
		$data['created'] = time();		
		$data['password'] = encrypt_pw($data['password'], $data['salt']);		
		$data['profile_pic'] = "images/silhoeutte.png";
		$data['blurb'] = "";
		$data['full_name'] = "";
		$data['website'] = "";
		$data['location'] = "";
		$data['last_login'] = time();
		$data['profile_views'] = 0;
		$data['validated'] = "false";
		$data['influence'] = 0;
		$data['posts_count'] = 0;
		$data['comments_count'] = 0;
		$data['tags_count'] = 0;
		$data['votes_count'] = 0;
		$data['pictures_count'] = 0;
		$data['achievement_score'] = 0;

		$this->mongo_db->insert('users', $data);
	}
	
	public function authenticate($username, $password) {
		
		$this->load->helper('encryption_helper');
		
		if ($u = $this->get_by_username($username)) {
			if ($u['password'] == encrypt_pw($password, $u['salt'])) {
				return $u;
			}
			return FALSE;
		}
		return FALSE;
	}
	
	public function change_password($username, $old_pw, $new_pw) {
	
		$this->load->helper('encryption_helper');
		
		if ($u = $this->get_by_username($username)) {
			if ($u['password'] == encrypt_pw($old_pw, $u['salt'])) {
				$new_pw = encrypt_pw($new_pw, $u['salt']);
				$this->update(array('username' => $username), array('password', $new_pw));
				return TRUE;
			}
			return FALSE;
		}
		return FALSE;
	
	}
	
	public function get_by_username($username) {
		
		$u = $this->mongo_db->where(array('username'=>$username))->limit(1)->get('users');
		if(sizeof($u) == 1) {
			return $u[0];
		} else {
			return FALSE;
		}
	}
	
	public function get_by_id($user_id) {
		
		$u = $this->mongo_db->where(array('_id'=>$user_id))->limit(1)->get('users');
		if(sizeof($u) == 1) {
			return $u[0];
		} else {
			return FALSE;
		}
	
	}
	
	public function update($where, $data) {
		
		$this->mongo_db->where($where)->set($data)->update('users');
		
	}
	
	public function change_pic($username, $picture) {
	
		$this->mongo_db->where(array('username' => $username))->set(array('profile_pic' => $picture))->update('users');
		$this->Spindlet->change_pic($username, $picture);
	
	}
	
	public function username_exists($username) {
	
		return ( $this->mongo_db->where(array('username' => $username))->count('users') > 0 );
	
	}
	
	public function email_exists($email) {
	
		return ( $this->mongo_db->where(array('email' => $email))->count('users') > 0 );
	
	}
	
	public function delete($username) {
		
		$this->mongo_db->where(array('username' => $username))->delete('users');
		
	}
	
	public function get_picture($username) {
	
		$u = $this->mongo_db->where(array('username' => $username))->limit(1)->get('users');
		
		return $u[0]['profile_pic'];
	
	}

	public function validate_email($username) {
		$this->mongo_db->where(array('username' => $username))->set(array('validated' => 'true'))->update('users');
	}

	public function get_list($constraints) {
		$pages = $this->User->get_pages_amount($constraints);
		if ($constraints['page'] > $pages) {
			$constraints['page'] = $pages;
		} else if ($constraints['page'] < 1) {
			$constraints['page'] = 1;
		}
		$total_users = $this->User->get_total($constraints);
		$this->mongo_db->offset(($constraints['page'] - 1) * $this->USERS_PER_PAGE)
		            ->limit($this->USERS_PER_PAGE)
		            ->order_by(array($constraints['tab'] => 'desc'));
		
		if (isset($constraints['search'])) {
			if ($constraints['search'] != "") {
				$this->mongo_db->or_like(array('username' => $constraints['search'],
					                           'full_name' => $constraints['search']));
			}
		}
		return $this->mongo_db->get('users');
	}

	public function get_total($constraints) {

		if (isset($constraints['search'])) {
			if ($constraints['search'] != "") {
				return $this->mongo_db->or_like(array('username' => $constraints['search'],
					                           'full_name' => $constraints['search']))
				                      ->count('users');
			}
		}
		return $this->mongo_db->count('users');
	}

	public function get_pages_amount($constraints) {
		return ceil($this->User->get_total($constraints) / $this->USERS_PER_PAGE);
	}

	public function get_all_data($username) {
		if ($this->User->username_exists($username)) {
			$data = array();
			$args = array();
			$args['username'] = $username;
			$args['type'] = 'short';
			$data['user_info'] = $this->User->get_by_username($username);
			$data['post_history'] = $this->Spindlet->get_post_history($args);
			$data['influence_history'] = $this->Influence->get_influence_history($args);
			$data['comment_history'] = $this->Spindlet->get_comment_history($args);
			$data['share_history'] = $this->Spindlet->get_share_history($args);
			$data['picture_history'] = $this->Spindlet->get_picture_history($args);
			$data['vote_history'] = $this->Vote->get_vote_history($args);
		} else {
			return false;
		}
	}	
}

?>