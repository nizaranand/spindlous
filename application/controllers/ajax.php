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
}