<h2 class="title"><?php echo link_to($result->getTitle(), 'snippet/show?id='.$result->getId()); ?></h2>
<?php if ($result->getMC() == 'true'): ?>
<?php echo image_tag('flag_blue.png', array('alt' => __('Managed Content'), 'title' => __('Managed Content'))) ?> 
<?php endif; ?>
<p><?php echo $result->getDescription() ?></p>
<?php include_partial('snippet/postedBy', array('code' => $result)) ?>