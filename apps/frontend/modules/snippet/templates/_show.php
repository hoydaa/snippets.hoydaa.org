<?php use_helper('I18N', 'sfRating', 'My') ?>

<div class="text">
    <h1>
        <span><?php echo link_to($code->getTitle(), 'snippet/show?id=' . $code->getId()); ?></span>
        <?php if ($code->getMC() == 'true'): ?>
        <?php echo image_tag('flag_blue.png', array('alt' => __('Managed Content'), 'title' => __('Managed Content'), 'style' => 'position: relative; bottom: 0;')) ?>
        <?php endif; ?>

        <?php if ($sf_user->isAuthenticated() && myUtils::isUserRecord('SnippetPeer', $code->getId(), $sf_user->getGuardUser()->getId())): ?>
        <?php echo link_to(image_tag('page_edit.png', array('alt' => __('Edit'), 'title' => __('Edit'))), 'snippet/edit?id=' . $code->getId()) ?>

        <?php echo link_to(image_tag('page_delete.png', array ('alt' => __('Delete'), 'title' => __('Delete'))), 'snippet/delete?id=' . $code->getId(), array('confirm' => 'Are you sure you want to delete this snippet?')) ?>
        <?php endif; ?>
    </h1>
    <?php echo $code->getBody() ?>
</div>

<p><?php echo snippet_posted_by($code) ?></p>

<?php echo sf_rater($code) ?>
<?php include_component('sfRating', 'ratingDetails', array('object' => $code)) ?>