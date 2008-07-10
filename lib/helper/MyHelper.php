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
	
function toggle($target, $up, $down)
{
  $context = sfContext::getInstance();

  $response = $context->getResponse();
  $response->addJavascript(sfConfig::get('sf_prototype_web_dir').'/js/prototype');
  $response->addJavascript(sfConfig::get('sf_prototype_web_dir').'/js/effects');
  $response->addJavascript(sfConfig::get('sf_prototype_web_dir').'/js/controls');
  $response->addJavascript('/js/rich');

  echo "<a href=\"#\" onclick=\"toogle('$target', '$up', '$down'); return false;\">";
  echo image_tag('minimize.gif', "id=$up");
  echo image_tag('maximize.gif', "id=$down style=display:none");
  echo "</a>";
}

?>