<?php use_helper('I18N', 'Validation', 'My') ?>

<h1><?php echo __('Change Email Address') ?></h1>

<?php echo form_tag('user/changeEmail') ?>
    <div class="row">
        <?php echo label_for('password', __('Password') . required()) ?>
        <?php echo input_password_tag('password') ?>
        <?php echo form_error('password') ?>
    </div>
    <div class="row">
        <?php echo label_for('new_email', __('New E-mail') . required()) ?>
        <?php echo input_tag('new_email', $sf_params->get('new_email')) ?>
        <?php echo form_error('new_email') ?>
    </div>
    <div class="row">
        <?php echo label_for('new_email_confirmation', __('Re-type New E-mail') . required()) ?>
        <?php echo input_tag('new_email_confirmation', $sf_params->get('new_email_confirmation')) ?>
        <?php echo form_error('new_email_confirmation') ?>
    </div>
    <div class="row right_col">
        <?php echo submit_tag(__('Submit')) ?>
    </div>
</form>