<?php use_helper('I18N', 'My') ?>

<h2 class="title"><?php echo link_to($result->getTitle(), 'snippet/show?id='.$result->getId()); ?></h2>
<?php if ($result->getMC() == 'true'): ?>
<?php echo image_tag('flag_blue.png', array('alt' => __('Managed Content'), 'title' => __('Managed Content'))) ?>
<?php endif; ?>
<p><?php echo $result->getSummary() ?></p>
<?php echo snippet_posted_by($result) ?>