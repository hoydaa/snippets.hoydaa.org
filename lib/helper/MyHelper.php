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
	
function toggle($target, $up, $down, $updown = null, $after = null)
{
  $context = sfContext::getInstance();

  $response = $context->getResponse();
  $response->addJavascript(sfConfig::get('sf_prototype_web_dir').'/js/prototype');
  $response->addJavascript(sfConfig::get('sf_prototype_web_dir').'/js/effects');
  $response->addJavascript(sfConfig::get('sf_prototype_web_dir').'/js/controls');
  $response->addJavascript('/js/rich');

  echo "<a href=\"#\" onclick=\"toogle('$target', '$up', '$down'); $after; return false; \">";
  $upstyle = "";
  $downstyle = " style=display:none";
  if($updown == "down") {
      $upstyle = $downstyle;
      $downstyle = "";
  }
  echo image_tag('minimize.gif', "id=$up$upstyle");
  echo image_tag('maximize.gif', "id=$down$downstyle");
  echo "</a>";
}

function required()
{
  return '<em class="required">*</em>';
}

function snippet_posted_by($code, $with_tags = true)
{
  $params = array();

  // Contributor parameter is set.
  if ($code->getSfGuardUserId())
  {
    $params['%contributor%'] = link_to($code->getContributor(), 'user/viewProfile?username=' . $code->getContributor());
  }
  else
  {
    $params['%contributor%'] = $code->getContributor();
  }

  // Date parameter is set.
  $params['%date%'] = format_date($code->getCreatedAt());

  if ($with_tags)
  {
    // Tags parameter is set.
    $tag_links = array();
    $tags = explode(', ', $code->getTag());

    for ($i = 0; $i < count($tags); $i++)
    {
      if ($tags[$i])
      {
        $tag_links[$i] = link_to($tags[$i], 'tag/show?tag=' . $tags[$i]);
      }
    }

    $params['%tags%'] = implode(', ', $tag_links);
  }

  if (isset($params['%tags%']))
  {
    return __('posted by %contributor% on %date% with tags %tags%', $params);
  }
  else
  {
    return __('posted by %contributor% on %date%', $params);
  }
}

function comment_posted_by($comment)
{
  $params = array();

  // Contributor parameter is set.
  if ($comment->getSfGuardUserId())
  {
    $params['%posted_by%'] = link_to($comment->getSfGuardUser()->getUsername(), 'user/viewProfile?username=' . $comment->getSfGuardUser()->getUsername());
  }
  else
  {
    $params['%posted_by%'] = $comment->getName();
  }

  // Date parameter is set.
  $params['%date%'] = format_date($comment->getCreatedAt());

  return __('posted by %posted_by% on %date%', $params);
}

?>