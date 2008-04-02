    <?php use_helper('Validation', 'I18N') ?>

    <?php use_helper('Object') ?>
    
    <?php use_helper('Validation') ?>
    
    <?php use_helper('My') ?>
    
    <?php echo form_tag('user/register', array('class' => 'edit')) ?>
    
        <span class="title"><?php echo __('Register') ?></span>
        
        <?php echo form_message($sf_request) ?>
        
        <div class="form-row">
            <?php echo form_error('username') ?>
            <?php echo label_for('username', __('Username'), array('class' => 'required')) ?>
        	<div class="input-cont">
                <?php echo input_tag('username', $sf_params->get('username')) ?>
            </div>
        </div>
        
        <div class="form-row">
            <?php echo form_error('first_name') ?>
            <?php echo label_for('first_name', __('First Name'), array('class' => 'required')) ?>
        	<div class="input-cont">
                <?php echo input_tag('first_name', $sf_params->get('first_name')) ?>
            </div>
        </div>        
        
        <div class="form-row">
            <?php echo form_error('last_name') ?>
            <?php echo label_for('last_name', __('Last Name'), array('class' => 'required')) ?>
        	<div class="input-cont">
                <?php echo input_tag('last_name', $sf_params->get('last_name')) ?>
            </div>
        </div>
        
        <div class="form-row">
            <?php echo form_error('email') ?>
            <?php echo label_for('email', __('Email'), array('class' => 'required')) ?>
        	<div class="input-cont">
                <?php echo input_tag('email', $sf_params->get('email')) ?>
            </div>
        </div>
        
        <div class="form-row">
            <?php echo form_error('password') ?>
            <?php echo label_for('password', __('Password'), array('class' => 'required')) ?>
        	<div class="input-cont">
                <?php echo input_password_tag('password') ?>
            </div>
        </div>        
        
        <div class="form-row">
        	<div class="input-cont">
            <?php echo submit_tag(__('Register')) ?>
        	</div>
        </div>
    
    </form>