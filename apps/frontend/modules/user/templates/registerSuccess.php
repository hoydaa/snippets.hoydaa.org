<?php use_helper('I18N', 'DateForm', 'Validation', 'My') ?>

<?php echo form_tag('user/register') ?>
	<?php echo form_message($sf_request) ?>
	<div class="row">
		<?php echo label_for('username', __('Username')) ?>
		<?php echo input_tag('username', $sf_params->get('username')) ?>
		<?php echo form_error('username') ?>
	</div>
	<div class="row">
		<?php echo label_for('password', __('Password')) ?>
		<?php echo input_password_tag('password') ?>
		<?php echo form_error('password') ?>
	</div>
	<div class="row">
		<?php echo label_for('password_confirmation', __('Re-type Password')) ?>
		<?php echo input_password_tag('password_confirmation') ?>
		<?php echo form_error('password_confirmation') ?>
	</div>
	<div class="row">
		<?php echo label_for('email', __('Email')) ?>
		<?php echo input_tag('email', $sf_params->get('email')) ?>
		<?php echo form_error('email') ?>
	</div>
	<div class="row">
		<?php echo label_for('email_confirmation', __('Re-type Email')) ?>
		<?php echo input_tag('email_confirmation', $sf_params->get('email_confirmation')) ?>
		<?php echo form_error('email_confirmation') ?>
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
	<div class="row">
		<?php echo label_for('gender', __('Gender')) ?>
		<?php echo select_tag('gender', options_for_select(array('M' => __('Male'), 'F' => __('Female')), $sf_params->get('gender'))) ?>
		<?php echo form_error('gender') ?>
	</div>
	<div class="row">
		<?php echo label_for('birthday', __('Birthday')) ?>
		<?php echo select_date_tag('birthday', $sf_params->get('birthday'), array ('year_start' => date("Y") - 100, 'year_end' => date("Y") - 10)) ?>
		<?php echo form_error('birthday') ?>
	</div>
	<div class="button-panel">
		<?php echo submit_tag(__('Sign Up')) ?>
	</div>
</form>