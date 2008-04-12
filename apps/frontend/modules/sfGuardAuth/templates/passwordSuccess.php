<?php use_helper('I18N', 'Validation') ?>

<?php echo form_tag('sfGuardAuth/password') ?>
	<div class="row">
		<?php echo label_for('email', __('Email')) ?>
		<?php echo input_tag('email', $sf_params->get('email')) ?>
		<?php echo form_error('email') ?>
	</div>        
	<div class="button-panel">
		<?php echo submit_tag(__('Submit')) ?>
	</div>
</form>