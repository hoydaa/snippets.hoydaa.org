<h1 class="title"><?php echo $code->getTitle() ?></h1>

<?php include_partial('snippet/show', array('code' => $code)) ?>

<?php include_partial('comment/list', array('comments' => $code->getComments())) ?>

<div id="comment_form-wrapper">
  <?php include_partial('comment/add') ?>
</div>