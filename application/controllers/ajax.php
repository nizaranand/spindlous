<?php

class Ajax extends CI_Controller {

	public function add_post() {
		if($u = Current_User::user()) {
			$data['author'] = $u->username;
			$data['url'] = $this->input->post('url');
			$data['title'] = $this->input->post('title');
			$data['body'] = $this->input->post('body');
			$data['tags'] = explode(' ', $this->input->post('tags'));
			$data['published'] = $this->input->post('published');
			$data['type'] = $this->input->post('type');
			$data['parent'] = $this->input->post('parent');
			$data['root'] = $this->input->post('root');
			$this->Spindlet->create($data);
		}
	}
	
	public function username_check() {
		
		$username = $this->input->post('username');
		if ( ($this->User->username_exists($username)) || ($this->Spindlet->id_exists($username)) ) {
			echo "exists";
		} else {
			echo "does_not_exist";
		}
			
	}
	
	public function email_check() {
		
		$email = $this->input->post('email');
		if ($this->User->email_exists($email)) {
			echo "exists";
		} else {
			echo "does_not_exist";
		}
		
	}
	
	public function website_scrape() {
		
		$url = $this->input->post('url');
		
		$ch = curl_init();
		$timeout = 5;
  		curl_setopt($ch,CURLOPT_URL,$url);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout);
	 	$data = curl_exec($ch);
		curl_close($ch);
		
		if(@$doc = DOMDocument::loadHTML($data)) {
			
			$images = $doc->getElementsByTagName("img");
			
			foreach ( $images as $image ) {
				
			echo $url . $image->attributes->getNamedItem("src")->nodeValue . "\n";

			}
			
		} else {
			
			echo "FAIL";
			
		}
		
		
	}
}