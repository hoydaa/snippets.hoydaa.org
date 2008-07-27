<?php use_helper('My', 'sfRating') ?>

<?php echo $code->getBody() ?>

<p><?php echo snippet_posted_by($code) ?></p>

<?php echo sf_rater($code) ?>
<?php include_component('sfRating', 'ratingDetails', array('object' => $code)) ?>