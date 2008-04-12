<?php use_helper('I18N', 'Validation', 'My') ?>

<?php echo form_tag('user/register') ?>
	<?php echo form_message($sf_request) ?>
	<div class="row">
		<?php echo label_for('username', __('Username'), array('class' => 'required')) ?>
		<?php echo input_tag('username', $sf_params->get('username')) ?>
		<?php echo form_error('username') ?>
	</div>
	<div class="row">
		<?php echo label_for('first_name', __('First Name'), array('class' => 'required')) ?>
		<?php echo input_tag('first_name', $sf_params->get('first_name')) ?>
		<?php echo form_error('first_name') ?>
	</div>
	<div class="row">
		<?php echo label_for('last_name', __('Last Name'), array('class' => 'required')) ?>
		<?php echo input_tag('last_name', $sf_params->get('last_name')) ?>
		<?php echo form_error('last_name') ?>
	</div>
	<div class="row">
		<?php echo label_for('email', __('Email'), array('class' => 'required')) ?>
		<?php echo input_tag('email', $sf_params->get('email')) ?>
		<?php echo form_error('email') ?>
	</div>
	<div class="row">
		<?php echo label_for('password', __('Password'), array('class' => 'required')) ?>
		<?php echo input_password_tag('password') ?>
		<?php echo form_error('password') ?>
	</div>
	<div class="button-panel">
		<?php echo submit_tag(__('Sign Up')) ?>
	</div>
</form>