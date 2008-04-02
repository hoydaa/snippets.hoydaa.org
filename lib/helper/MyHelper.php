<?php

	function form_message($sf_request) {
		$rtn = "";
		if($sf_request->hasError('form-message')) {
		    $errors = $sf_request->getError('form-message');
			$rtn .= '<ul class="form-message">';
			foreach($errors as $error) {
			    $rtn.="<li>".$error."</li>";
			}
			$rtn .= '</ul>';
		}
		return $rtn;
	} 

	function getNumberOfRatings($rating_detail) {
	    $cnt = 0;
	    foreach($rating_detail as $rate => $count) {
	        $cnt += $count;
	    }
	    return $cnt;
	}
	
	function link_to_tags($tags) {
	    $rtn = "";
	    $arr = explode(" ", $tags);
	    foreach($arr as $tag) {
	        $rtn .= " " . link_to($tag, 'sfLucene/search?query=tags:' . $tag);
	    }
	    return trim($rtn);
	}
	
	function link_to_languages($language_tags) {
	    $rtn = "";
	    $arr = explode(" ", $language_tags);
	    foreach($arr as $language_tag) {
	        $rtn .= " " . link_to($language_tag, 'sfLucene/search?query=languages:' . $language_tag);
	    }
	    return trim($rtn);
	}
	
?>