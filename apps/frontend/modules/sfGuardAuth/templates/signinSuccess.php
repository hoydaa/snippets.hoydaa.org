<?php use_helper('I18N', 'Validation', 'My') ?>
<?php special_append_to_page_title('Sign In') ?>

<h1><?php echo __('Sign In') ?></h1>

<?php echo form_tag('@sf_guard_signin', array('class' => 'form')) ?>
    <div class="row">
        <?php echo label_for('username', __('Username') . required()) ?>
        <?php echo input_tag('username', $sf_params->get('username')) ?><br />
        <?php echo form_error('username', 'class=error') ?>
    </div>
    <div class="row">
        <?php echo label_for('password', __('Password') . required()) ?>
        <?php echo input_password_tag('password'); ?><br />
        <?php echo form_error('password', 'class=error') ?> 
    </div>
    <div class="row">
        <?php echo label_for('remember', __('Remember me?')) ?>
        <?php echo checkbox_tag('remember') ?>
    </div>
    <div class="row right_col">
        <?php echo submit_tag(__('Sign In')) ?>
    </div>
</form>
<br />
<?php echo link_to(__('Forgot your password?'), '@sf_guard_password', array('id' => 'sf_guard_auth_forgot_password')) ?>