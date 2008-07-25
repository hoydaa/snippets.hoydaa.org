<?php use_helper('I18N', 'Object', 'DateForm', 'Validation') ?>

<h1><?php echo __('Edit Profile') ?></h1>

<?php include_partial('site/message') ?>

<?php echo form_tag('user/editProfile', array('class' => 'form')) ?>
    <div class="row">
        <?php echo label_for('email', __('Email')) ?>
        <?php echo input_tag('email', $sf_params->get('email')) ?>
        <?php echo form_error('email') ?>
    </div>
    <div class="row">
        <?php echo label_for('first_name', __('First Name')) ?>
        <?php echo input_tag('first_name', $sf_params->get('first_name')) ?>
        <?php echo form_error('first_name') ?>
    </div>
    <div class="row">
        <?php echo label_for('last_name', __('Last Name')) ?>
        <?php echo input_tag('last_name', $sf_params->get('last_name')) ?>
        <?php echo form_error('last_name') ?>
    </div>
    <div class="row right_col">
        <?php echo submit_tag(__('Save')) ?>
    </div>
</form>