<?php use_helper('I18N', 'Validation', 'My') ?>

<?php echo form_tag('sfGuardAuth/password') ?>
	<div class="row">
		<?php echo label_for('email', __('Email') . required()) ?>
		<?php echo input_tag('email', $sf_params->get('email')) ?>
		<?php echo form_error('email') ?>
	</div>        
	<div class="row right_col">
		<?php echo submit_tag(__('Submit')) ?>
	</div>
</form>