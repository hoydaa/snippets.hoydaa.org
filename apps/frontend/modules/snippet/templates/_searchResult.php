<?php use_helper('I18N', 'My') ?>

<h2>
    <span><?php echo link_to($result->getTitle(), 'snippet/show?id='.$result->getStrippedTitle()); ?></span>
    <?php if ($result->getMC() == 'true'): ?>
    <?php echo image_tag('flag_blue.png', array('alt' => __('Managed Content'), 'title' => __('Managed Content'))) ?>
    <?php endif; ?>
</h2>
<p><?php echo $result->getSummary() ?></p>
<p><?php echo snippet_posted_by($result) ?></p>