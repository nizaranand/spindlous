<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('get_pagination_buttons')) {
    function get_pagination_buttons($args) {
    	$buttons = array();
        $CI = get_instance();
        $total_pages = $CI->User->get_pages_amount($args);
    	if($total_pages > 9) {
    		if ($args['page'] >= 1 && $args['page'] <= 4) {

    			if ($args['page'] != 1) {
	    			$buttons[] = get_button_html('previous_page', $args);
	    		}
    			for($i = 1; $i <= 5; $i++) {
					$buttons[] = get_button_html((int)$i, $args);
				}
    			$buttons[] = get_button_html('ellipses', $args);
    			$buttons[] = get_button_html((int)$total_pages, $args);
    			$buttons[] = get_button_html('next_page', $args);

    		} else if ($args['page'] >= 5 && $args['page'] <= ($total_pages - 4)) {

                $buttons[] = get_button_html('previous_page', $args);
    			$buttons[] = get_button_html(1, $args);
    			$buttons[] = get_button_html('ellipses', $args);
    			for($i = ($args['page'] - 2); $i <= ($args['page'] + 2); $i++) {
					$buttons[] = get_button_html((int)$i, $args);
				}
    			$buttons[] = get_button_html('ellipses', $args);
    			$buttons[] = get_button_html((int)$total_pages, $args);
    			$buttons[] = get_button_html('next_page', $args);

    		} else {

    			$buttons[] = get_button_html('previous_page', $args);
    			$buttons[] = get_button_html(1, $args);
    			$buttons[] = get_button_html('ellipses', $args);
    			for($i = ($total_pages - 4); $i <= $total_pages; $i++) {
					$buttons[] = get_button_html((int)$i, $args);
				}
    			if ($args['page'] != $total_pages) {
	    			$buttons[] = get_button_html('next_page', $args);
	    		}
   			}
    	} else {
    		if ($args['page'] != 1) {
    			$buttons[] = get_button_html('previous_page', $args);
    		}
    		for($i = 1; $i <= $total_pages; $i++) {
    			$buttons[] = get_button_html((int)$i, $args);
    		}
    		if ($args['page'] != $total_pages) {
    			$buttons[] = get_button_html('next_page', $args);
    		}
    	}
    	return $buttons;
    }
}

if ( ! function_exists('get_button_html')) {
    function get_button_html($button, $args) {
        //Construct the argument string for the URL:
        $arg_string = "&";
        foreach ($args as $key => $arg) {
            if ($arg != "" && $key != "page") {
                $arg_string = $arg_string . $key . "=" . $arg . "&";
            }
        }
        $arg_string = substr($arg_string, 0, -1);
        $current_page = $args['page'];
        if (is_int($button)) {
            if ($button == $current_page) {
                return "<div class='pagination-button page-number active'>" . $button . "</div>";
            } else {
                return "<div class='pagination-button page-number'><a href='" . base_url() ."users?page=" . $button . $arg_string . "'>" . $button . "</a></div>";
            }
        } else {
            switch($button) {
                case 'previous_page':
                    return "<div class='pagination-button next-button'><a href='" . base_url() ."users?page=" . ($current_page - 1) . $arg_string . "'>prev</a></div>";
                case 'ellipses':
                    return "<div class='pagination-button ellipses'>...</div>";
                case 'next_page': 
                    return "<div class='pagination-button next-button'><a href='" . base_url() ."users?page=" . ($current_page + 1) . $arg_string . "'>next</a></div>";
                default: return "";
            } 
        }
    }
}

