    <?php use_helper('Validation', 'I18N') ?>

    <?php use_helper('Object') ?>
    
    <?php use_helper('Validation') ?>
    
    <?php use_helper('My') ?>
    
    <?php echo form_tag('user/changePassword', array('class' => 'edit')) ?>
    
        <span class="title"><?php echo __('Change Password') ?></span>
        
        <?php echo form_message($sf_request) ?>
        
        <div class="form-row">
            <?php echo form_error('old_password') ?>
            <?php echo label_for('old_password', __('Old Password'), array('class' => 'required')) ?>
        	<div class="input-cont">
                <?php echo input_password_tag('old_password') ?>
            </div>
        </div>
        
        <div class="form-row">
            <?php echo form_error('new_password') ?>
            <?php echo label_for('new_password', __('New Password'), array('class' => 'required')) ?>
        	<div class="input-cont">
                <?php echo input_password_tag('new_password') ?>
            </div>
        </div>        
        
        <div class="form-row">
            <?php echo form_error('new_password_confirm') ?>
            <?php echo label_for('new_password_confirm', __('Confirm New Password'), array('class' => 'required')) ?>
        	<div class="input-cont">
                <?php echo input_password_tag('new_password_confirm') ?>
            </div>
        </div>                
        
        <div class="form-row">
        	<div class="input-cont">
            <?php echo submit_tag(__('Submit')) ?>
        	</div>
        </div>
    
    </form>