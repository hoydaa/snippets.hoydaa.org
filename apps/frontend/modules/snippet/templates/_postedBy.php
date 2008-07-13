<?php use_helper('I18N', 'Date') ?>

<?php

$params = array();

if ($code->getSfGuardUserId())
  $params['%contributor%'] = link_to($code->getContributor(), 'user/viewProfile?username='.$code->getContributor());
else
  $params['%contributor%'] = $code->getContributor();

$params['%date%'] = format_date($code->getCreatedAt());

$tags = explode(', ', $code->getTag());

for ($i = 0; $i < count($tags); $i++)
  $tags[$i] = link_to($tags[$i], 'tag/show?tag='.$tags[$i]);

$params['%tags%'] = implode(', ', $tags);

?>

<?php echo __('posted by %contributor% on %date% with tags %tags%', $params) ?>