<?php use_helper('I18N', 'Validation', 'Javascript', 'Cryptographp', 'My') ?>

<h1><?php echo __('Add/Edit Snippet') ?></h1>

<?php echo form_tag('snippet/update', array('class' => 'form')) ?>
    <?php echo input_hidden_tag('id', $sf_params->get('id')) ?>
    <?php if(!$sf_user->isAuthenticated()): ?>
    <div class="row">
        <?php echo label_for('name', __('Name') . required()) ?>
        <?php echo input_tag('name', $sf_params->get('name')) ?>
        <?php echo form_error('name') ?>
    </div>
    <div class="row">
        <?php echo label_for('email', __('Email') . required()) ?>
        <?php echo input_tag('email', $sf_params->get('email')) ?>
        <?php echo form_error('email') ?>
    </div>
    <?php endif; ?>
    <div class="row">
        <?php echo label_for('title', __('Title') . required()) ?>
        <?php echo input_tag('title', $sf_params->get('title')) ?>
        <?php echo form_error('title') ?>
    </div>
    <div class="row">
        <?php echo label_for('raw_body', __('Body') . required()) ?>
        <?php echo textarea_tag('raw_body', $sf_params->get('raw_body'), 'class=body') ?>
        <?php echo link_to(image_tag('help.png', array('alt' => __('Markdown Syntax'), 'title' => __('Markdown Syntax'))), 'site/popup?content=markdown', array('popup' => array(__('Markdown Syntax'), 'width=600, height=500, resizable, scrollbars=yes'))) ?>
        <?php echo form_error('raw_body') ?>
    </div>
    <div class="row">
        <?php echo label_for('tags', __('Tags')) ?>
        <?php echo input_auto_complete_tag('tags',  $sf_params->get('tags'), 'tag/autocomplete', array('autocomplete' => 'off'), array('use_style' => 'true', 'tokens' => ',')) ?>
        <?php echo form_error('tags') ?>
    </div>
    <?php if($sf_user->isAuthenticated() && $sf_user->hasGroup('EDITOR')): ?>
    <div class="row">
        <?php echo label_for('managed_content', __('Managed Content')) ?>
        <?php echo checkbox_tag('managed_content', '1', $sf_params->get('managed_content')) ?>
        <?php echo form_error('managed_content') ?>
    </div>
    <?php endif; ?>
    <?php if (!$sf_params->get('id')): ?>
    <div class="row right_col">
        <?php echo cryptographp_picture() ?><?php echo cryptographp_reload() ?>
    </div>
    <div class="row">
        <?php echo label_for('captcha', __('Type the code shown') . required()) ?>
        <?php echo input_tag('captcha', $sf_params->get('captcha')) ?>
        <?php echo form_error('captcha') ?>
    </div>
    <?php endif; ?>
    <div class="row right_col">
        <?php echo submit_tag(__('Save')) ?>
    </div>
</form>