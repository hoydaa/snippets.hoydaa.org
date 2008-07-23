<?php use_helper('I18N', 'Date') ?>

<h1><?php echo __('Your Snippets') ?></h1>

<?php include_partial('snippet/list', array('pager' => $pager)) ?>