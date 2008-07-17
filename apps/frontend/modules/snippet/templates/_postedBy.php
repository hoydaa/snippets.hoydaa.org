<?php use_helper('I18N', 'Date') ?>

<?php

$params = array();

// Contributor parameter is set.
if ($code->getSfGuardUserId())
{
  $params['%contributor%'] = link_to($code->getContributor(), 'user/viewProfile?username='.$code->getContributor());
}
else
{
  $params['%contributor%'] = $code->getContributor();
}

// Date parameter is set.
$params['%date%'] = format_date($code->getCreatedAt());

// Tags parameter is set.
$tag_links = array();
$tags = explode(', ', $code->getTag());

for ($i = 0; $i < count($tags); $i++)
{
  if ($tags[$i])
  {
    $tag_links[$i] = link_to($tags[$i], 'tag/show?tag='.$tags[$i]);
  }
}

$params['%tags%'] = implode(', ', $tag_links);

// Posted by expression is printed.
if ($params['%tags%'])
{
  echo __('posted by %contributor% on %date% with tags %tags%', $params);
}
else
{
  echo __('posted by %contributor% on %date%', $params);
}

?>