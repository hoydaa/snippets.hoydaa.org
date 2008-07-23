<?php use_helper('I18N') ?>

<h1><?php echo __('Snippets with %language% code.', array('%language%' => myUtils::item(sfConfig::get('app_languages'), $sf_params->get('language')))) ?></h1>

<?php include_partial('snippet/list', array('pager' => $pager)) ?>