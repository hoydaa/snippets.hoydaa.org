<?php use_helper('My') ?>

<?php echo comment_posted_by($comment) ?>
<?php echo $comment->getBody() ?>