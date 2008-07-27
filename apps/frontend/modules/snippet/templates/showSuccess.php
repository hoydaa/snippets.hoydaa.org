<?php use_helper('I18N') ?>

<h1>
    <span><?php echo $code->getTitle() ?></span>
    <?php if ($code->getMC() == 'true'): ?>
    <?php echo image_tag('flag_blue.png', array('alt' => __('Managed Content'), 'title' => __('Managed Content'))) ?>
    <?php endif; ?>

    <?php if ($sf_user->isAuthenticated() && myUtils::isUserRecord('SnippetPeer', $code->getId(), $sf_user->getGuardUser()->getId())): ?>
    <?php echo link_to(image_tag('page_edit.png', array('alt' => __('Edit'), 'title' => __('Edit'))), 'snippet/edit?id=' . $code->getId()) ?>

    <?php echo link_to(image_tag('page_delete.png', array ('alt' => __('Delete'), 'title' => __('Delete'))), 'snippet/delete?id=' . $code->getId(), array('confirm' => 'Are you sure you want to delete this snippet?')) ?>
    <?php endif; ?>
</h1>

<?php include_partial('snippet/show', array('code' => $code)) ?>

<?php include_partial('comment/list', array('comments' => $code->getComments())) ?>

<div id="comment_form-wrapper">
  <?php include_partial('comment/add') ?>
</div>