<?php use_helper('I18N') ?>

<?php echo image_tag('banner.gif') ?>

<?php foreach ($snippets as $snippet): ?>
<h1>
    <span><?php echo link_to($snippet->getTitle(), 'snippet/show?id=' . $snippet->getFriendlyUrl()); ?></span>
    <?php if ($snippet->getMC() == 'true'): ?>
    <?php echo image_tag('flag_blue.png', array('alt' => __('Managed Content'), 'title' => __('Managed Content'))) ?>
    <?php endif; ?>

    <?php if ($sf_user->isAuthenticated() && myUtils::isUserRecord('SnippetPeer', $snippet->getId(), $sf_user->getGuardUser()->getId())): ?>
    <?php echo link_to(image_tag('page_edit.png', array('alt' => __('Edit'), 'title' => __('Edit'))), 'snippet/edit?id=' . $snippet->getId()) ?>

    <?php echo link_to(image_tag('page_delete.png', array ('alt' => __('Delete'), 'title' => __('Delete'))), 'snippet/delete?id=' . $snippet->getId(), array('confirm' => 'Are you sure you want to delete this snippet?')) ?>
    <?php endif; ?>
</h1>
<?php include_partial('snippet/show', array('code' => $snippet)) ?>
<div class="hr"></div>
<?php endforeach ?>