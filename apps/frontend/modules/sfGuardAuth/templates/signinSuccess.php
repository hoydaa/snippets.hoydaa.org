<?php

?><?php use_helper('Validation', 'I18N', 'My') ?>

<div id="sf_guard_auth_form">
<?php echo form_tag('@sf_guard_signin', array('class' => 'edit')) ?>

	<span class="title">Sign In Form</span>
	
        <?php echo form_message($sf_request) ?>	

    <div class="form-row" id="sf_guard_auth_username">
      <?php
      echo form_error('username'), 
      label_for('username', __('Username:'), array('class' => 'required')) ?>
      <div class="input-cont">
          <?php echo input_tag('username', $sf_data->get('sf_params')->get('username')); ?>
      </div>
    </div>

    <div class="form-row" id="sf_guard_auth_password">
      <?php
      echo form_error('password'), 
        label_for('password', __('Password:'), array('class' => 'required')) ?>
      <div class="input-cont">
          <?php echo input_password_tag('password'); ?>
      </div>
    </div>
    <div class="form-row" id="sf_guard_auth_remember">
      <?php
      echo label_for('remember', __('Remember me?')) ?>
      <div class="input-cont">
      	<?php echo checkbox_tag('remember'); ?>
      </div>
    </div>
    
    <div class="form-row" id="sf_guard_auth_remember">
      <div class="input-cont">
      	<?php echo submit_tag(__('Sign In')),
            link_to(__('Forgot your password?'), '@sf_guard_password', array('id' => 'sf_guard_auth_forgot_password'));
      	?>
      </div>
    </div>
</form>
</div>
