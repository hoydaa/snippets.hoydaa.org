<?php use_helper('Validation', 'I18N', 'My') ?>

<?php echo form_tag('@sf_guard_signin') ?>
	<div class="row">
		<?php echo label_for('username', __('Username').':') ?>
		<?php echo input_tag('username', $sf_data->get('sf_params')->get('username')) ?><br />
		<?php echo form_error('username', 'class=error') ?>
	</div>
	<div class="row">
		<?php echo label_for('password', __('Password').':') ?>
		<?php echo input_password_tag('password'); ?><br />
		<?php echo form_error('password', 'class=error') ?> 
	</div>
	<div class="row">
		<?php echo label_for('remember', __('Remember me?')) ?>
		<?php echo checkbox_tag('remember') ?>
	</div>
	<div class="button-panel">
		<?php echo submit_tag(__('Sign In')) ?>
	</div>
</form>
<br />
<?php echo link_to(__('Forgot your password?'), '@sf_guard_password', array('id' => 'sf_guard_auth_forgot_password')) ?>