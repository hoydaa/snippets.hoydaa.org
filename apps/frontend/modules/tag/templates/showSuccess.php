<?php use_helper('I18N', 'My') ?>
<?php special_append_to_page_title(__('Languages') . ' : ' . $sf_params->get('tag')); ?>

<h1><?php echo __('Snippets tagged with "%tag%".', array('%tag%' => $sf_params->get('tag'))) ?></h1>

<?php include_partial('snippet/list', array('pager' => $pager)) ?>