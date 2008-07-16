<?php use_helper('I18N', 'Text', 'sfRating') ?>

<h1><?php echo $code->getTitle() ?></h1>
<?php if($sf_user->isAuthenticated() && myUtils::isUserRecord('SnippetPeer', $code->getId(), $sf_user->getGuardUser()->getId())): ?>
<?php echo link_to(image_tag('page_edit.png', array ('alt' => __('Edit'), 'title' => __('Edit'))), 'snippet/edit?id=' . $code->getId()) ?> <?php echo link_to(image_tag('page_delete.png', array ('alt' => __('Delete'), 'title' => __('Delete'))), 'snippet/delete?id=' . $code->getId(), array ('confirm' => 'Are you sure you want to delete this snippet?')) ?>
<?php endif; ?>
<p><?php echo simple_format_text($code->getBody()) ?></p>
<?php include_partial('snippet/postedBy', array('code' => $code)) ?>
<br /><br />
<?php echo sf_rater($code) ?>
<?php include_component('sfRating', 'ratingDetails', array('object' => $code)) ?>

<?php include_partial('comment/list', array('comments' => $code->getComments())) ?>

<div id="comment_form-wrapper">
  <?php include_partial('comment/add') ?>
</div>