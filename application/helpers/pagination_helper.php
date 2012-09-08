<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('get_pagination_buttons')) {
    function get_pagination_buttons($page, $total_pages, $data) {
    	$buttons = array();
        
    	if($total_pages > 9) {
    		if ($page == 1) {
    			if ($page != 1) {
	    			$buttons[] = array(
	    				"type" => "previous_button",
	    				"value" => "prev",
	    				"active" => "inactive",
                        "url" => format_button_url($page, $page, $data),
	    			);
	    		}
    			for($i = 1; $i <= 5; $i++) {
					$buttons[] = array(
						"type" => ($i == $page) ? "active_number" : "page_number",
						"value" => $i,
						"active" => ($i == $page) ? "active" : "inactive",
					);
				}
    			$buttons[] = array(
    				"type" => "ellipses",
    				"value" => "...",
    				"active" => "inactive",
                    "url" => "",
    			);
    			$buttons[] = array(
    				"type" => "page_number",
    				"value" => $total_pages,
    				"active" => "inactive",
    			);
    			$buttons[] = array(
    				"type" => "next_button",
    				"value" => "next",
    				"active" => "inactive"
    			);
    		} else if ($page >= 5 && $page <= ($total_pages - 4)) {
    			$buttons[] = array(
    				"type" => "previous_button",
    				"value" => "prev",
    				"active" => "inactive"
    			);
    			$buttons[] = array(
    				"type" => "page_number",
    				"value" => 1,
    				"active" => "inactive"
    			);
    			$buttons[] = array(
    				"type" => "ellipses",
    				"value" => "...",
    				"active" => "inactive",
    			);
    			for($i = ($page - 2); $i <= ($page + 2); $i++) {
					$buttons[] = array(
						"type" => ($i == $page) ? "active_number" : "page_number",
						"value" => $i,
						"active" => ($i == $page) ? "active" : "inactive",
					);
				}
    			$buttons[] = array(
    				"type" => "ellipses",
    				"value" => "...",
    				"active" => "inactive",
    			);
    			$buttons[] = array(
    				"type" => "page_number",
    				"value" => $total_pages,
    				"active" => "inactive",
    			);
    			$buttons[] = array(
    				"type" => "next_button",
    				"value" => "next",
    				"active" => "inactive"
    			);
    		} else {
    			$buttons[] = array(
    				"type" => "previous_button",
    				"value" => "prev",
    				"active" => "inactive"
    			);
    			$buttons[] = array(
    				"type" => "page_number",
    				"value" => 1,
    				"active" => "inactive"
    			);
    			$buttons[] = array(
    				"type" => "ellipses",
    				"value" => "...",
    				"active" => "inactive",
    			);
    			for($i = ($total_pages - 4); $i <= $total_pages; $i++) {
					$buttons[] = array(
						"type" => ($i == $page) ? "active_number" : "page_number",
						"value" => $i,
						"active" => ($i == $page) ? "active" : "inactive",
					);
				}
    			if ($page != $total_pages) {
	    			$buttons[] = array(
	    				"type" => "next_button",
	    				"value" => "next",
	    				"active" => "inactive"
	    			);
	    		}
   			}

    	} else {
    		if ($page != 1) {
    			$buttons[] = array(
    				"type" => "previous_button",
    				"value" => "prev",
    				"active" => "inactive"
    			);
    		}
    		for($i = 1; $i <= $total_pages; $i++) {
    			$buttons[] = array(
    				"type" => ($i == $page) ? "active_number" : "page_number",
    				"value" => $i,
    				"active" => ($i == $page) ? "active" : "inactive",
    			);
    		}
    		if ($page != $total_pages) {
    			$buttons[] = array(
    				"type" => "next_button",
    				"value" => "next",
    				"active" => "inactive"
    			);
    		}
    	}
    	return $buttons;
    }
}

if ( ! function_exists('format_button_url')) {
    function format_button_url($current_page, $button_page, $data) {
        $filter = '&filter=' . $data['filter'];
        $tab = '&tab=' . $data['tab'];
        $search = ($data['search'] == '') ? '' : ('&search=' . $data['search']);
    }
}
        