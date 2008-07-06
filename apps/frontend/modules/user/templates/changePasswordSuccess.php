<?php use_helper('I18N', 'Validation') ?>

<h1><?php echo __('Change Password') ?></h1>

<?php echo form_tag('user/changePassword') ?>
	<div class="row">
		<?php echo label_for('old_password', __('Old Password')) ?>
		<?php echo input_password_tag('old_password') ?>
		<?php echo form_error('old_password') ?>
	</div>
	<div class="row">
		<?php echo label_for('new_password', __('New Password')) ?>
		<?php echo input_password_tag('new_password') ?>
		<?php echo form_error('new_password') ?>
	</div>
	<div class="row">
		<?php echo label_for('new_password_confirm', __('Confirm New Password')) ?>
		<?php echo input_password_tag('new_password_confirm') ?>
		<?php echo form_error('new_password_confirm') ?>
	</div>
		<div class="button-panel">
		<?php echo submit_tag(__('Submit')) ?>
	</div>
</form>