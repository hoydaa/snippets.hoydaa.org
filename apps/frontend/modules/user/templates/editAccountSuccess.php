<?php use_helper('I18N', 'Validation', 'DateForm') ?>

<h1><?php echo __('Edit Account Settings') ?></h1>

<?php include_partial('site/message') ?>

<?php echo form_tag('user/editAccount') ?>
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
    <div class="row">
        <?php echo label_for('gender', __('Gender')) ?>
        <?php echo select_tag('gender', options_for_select(array(null, 'M' => __('Male'), 'F' => __('Female')), $sf_params->get('gender'))) ?>
        <?php echo form_error('gender') ?>
    </div>
    <div class="row">
        <?php echo label_for('birthday', __('Birthday')) ?>
        <?php echo input_date_tag('birthday', $sf_params->get('birthday'), 'class=date rich=true') ?>
        <?php echo form_error('birthday') ?>
    </div>
    <div class="button-panel">
        <?php echo submit_tag(__('Save')) ?>
    </div>
</form>