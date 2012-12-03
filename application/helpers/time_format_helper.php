<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('short_time_formatter')) {
    function short_time_formatter($timestamp) {
   		$difference = time() - $timestamp;
   		if ($difference < 60) {
   			return $difference . "s";
   		} else if ($difference < 3600) {
   			return floor($difference / 60) . "m";
   		} else if ($difference < 86400) {
   			return floor($difference / 3600) . "h";
   		} else if ($difference < 172800) {
   			return "Yesterday";
   		} else if ($difference < 31536000) {
   			date('j M' , $timestamp);
   		} else {
   			date('j M y', $timestamp);
   		}
    }   
}

if ( ! function_exists('long_time_formatter')) {
    function long_time_formatter($timestamp) {
        $difference = time() - $timestamp;
        if ($difference < 60) {
   			return "moments ago";
   		} else if ($difference < 3600) {
        $minutes = floor($difference / 60);
        if ($minutes == 1) {
          return "1 minute ago.";
        } else {
          return $minutes . " minutes ago.";  
        }
   		} else if ($difference < 86400) {
   			$hours = floor($difference / 3600);
        if ($hours == 1) {
          return "1 hour ago.";
        } else {
          return $hours . " hours ago.";  
        }
   		} else if ($difference < 172800) {
   			return "yesterday";
   		} else if ($difference < 31536000) {
   			date('F jS' , $timestamp);
   		} else {
   			date('F jS Y', $timestamp);
   		}
    }   
}

if ( ! function_exists('member_time_formatter')) {
	function member_time_formatter($timestamp) {
		$difference = time() - $timestamp;
		if ($difference < 60) {
        if ($difference == 1) {
          return "Member for " . $difference . " second.";
        } else {
          return "Member for " . $difference . " seconds.";  
        }
   		} else if ($difference < 3600) {
        $minutes = floor($difference / 60);
        if ($minutes == 1) {
          return "Member for 1 minute.";
        } else {
          return "Member for " . $minutes . " minutes.";
        }
   		} else if ($difference < 86400) {
        $hours = floor($difference / 3600);
        if ($hours == 1) {
          return "Member for " . $hours . " hour.";
        } else {
          return "Member for " . $hours . " hours.";
        }
   		} else if ($difference < 172800) {
   			return "Member since yesterday.";
   		} else if ($difference < 2592000) {
   			return "Member for " . floor($difference / 86400) . " days.";
   		} else if ($difference < 31536000) {
   			$months = floor($difference / 2592000);
   			if ($months == 1) {
   				return "Member for one month.";
   			} else {
   				return "Member for " . $months . " months.";
   			}
   		} else {
   			$years = floor($difference / 31536000);
   			if ($years == 1) {
   				return "Member for one year.";
   			} else {
   				return "Member for " . $years . " years.";
   			}
   		}
	}
}

?>