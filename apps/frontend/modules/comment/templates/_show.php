<?php use_helper('I18N', 'Date', 'Markdown') ?>

<?php

$params = array();

if ($comment->getSfGuardUserId())
  $params['%posted_by%'] = link_to($comment->getSfGuardUser()->getUsername(), 'user/viewProfile?username='.$comment->getSfGuardUser()->getUsername());
else
  $params['%posted_by%'] = $comment->getName();

$params['%date%'] = format_date($comment->getCreatedAt());

?>

<?php echo __('%posted_by% on %date%', $params) ?>
<?php echo convert_markdown_text($comment->getBody()) ?>