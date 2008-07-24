<?php use_helper('I18N', 'sfRating', 'My') ?>

<?php if ($code->getMC() == 'true'): ?>
<?php echo image_tag('flag_blue.png', array('alt' => __('Managed Content'), 'title' => __('Managed Content'))) ?>
<?php endif; ?>

<?php if ($sf_user->isAuthenticated() && myUtils::isUserRecord('SnippetPeer', $code->getId(), $sf_user->getGuardUser()->getId())): ?>
<?php echo link_to(image_tag('page_edit.png', array('alt' => __('Edit'), 'title' => __('Edit'))), 'snippet/edit?id=' . $code->getId()) ?>

<?php echo link_to(image_tag('page_delete.png', array ('alt' => __('Delete'), 'title' => __('Delete'))), 'snippet/delete?id=' . $code->getId(), array('confirm' => 'Are you sure you want to delete this snippet?')) ?>
<?php endif; ?>

<div class="snippet_body">
    <?php echo $code->getBody() ?>
</div>

<?php echo snippet_posted_by($code) ?>
<br /><br />
<?php echo sf_rater($code) ?>
<?php include_component('sfRating', 'ratingDetails', array('object' => $code)) ?>