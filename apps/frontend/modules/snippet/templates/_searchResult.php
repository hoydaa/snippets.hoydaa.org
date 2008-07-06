<h2><?php echo link_to($result->getTitle(), 'snippet/show?id='.$result->getId()); ?></h2>
<p><?php echo $result->getDescription() ?></p>
<?php include_partial('snippet/postedBy', array('code' => $result)) ?>