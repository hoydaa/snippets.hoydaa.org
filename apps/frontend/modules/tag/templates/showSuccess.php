<?php use_helper('I18N') ?>

<h1><?php echo __('Snippets tagged as %1%.', array('%1%' => link_to($sf_params->get('tag'), 'tag/show?tag='.$sf_params->get('tag')))) ?></h1>

<?php include_partial('snippet/list', array('pager' => $pager)) ?>