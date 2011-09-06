<?php

class Test extends CI_Controller {

	function __construct()
	{ 
		parent::__construct();
	}
	
	function index() {
		
		$url = "http://www.google.com";
		
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
				
			echo $url . $image->attributes->getNamedItem("src")->nodeValue;

			}
			
		} else {
			
			echo "FAIL";
			
		}
	
	
	}	
}