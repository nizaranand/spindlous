<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Comment_Node {
	
	public $comment;
	public $parentc;
	public $root;
	public $children = Array();
	public $size;
	public $vote;

	public function __construct($comment, $carray, $votes, $user) {
		
		$this->comment  = $comment;
		$this->parentc  = $comment['parent'];
		$this->root     = $comment['root'];
		$this->size     = sizeof($carray);
		if($user) {
			$this->vote = $this->find_vote($votes, $user);
		} else {
			$this->vote = false;
		}
		
		foreach ($carray as $c) {
		
			if($c['parent'] == $this->comment['sid']) {
			
				$this->children[] = new Comment_Node($c, $carray, $votes, $user);
			
			}
		
		}
		
	}
	
	private function find_vote($votes, $sid) {

		foreach($votes as $vote) {
		
			if ($vote['sid'] == $sid) {
				return $vote;
			}
		
		}
		return false;

	} 

}