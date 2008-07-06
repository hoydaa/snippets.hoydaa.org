<?php use_helper('I18N', 'Text', 'sfRating') ?>

<h1><?php echo $code->getTitle() ?></h1>
<p><?php echo simple_format_text($code->getBody()) ?></p>
<?php include_partial('snippet/postedBy', array('code' => $code)) ?>

<?php echo sf_rater($code) ?>
<?php include_component('sfRating', 'ratingDetails', array('object' => $code)) ?>

<?php include_partial('comment/list', array('comments' => $code->getComments())) ?>

<div id="comment_form-wrapper">
  <?php include_partial('comment/add') ?>
</div>