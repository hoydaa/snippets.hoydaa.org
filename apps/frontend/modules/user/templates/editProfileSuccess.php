    <?php use_helper('Validation', 'I18N') ?>

    <?php use_helper('Object') ?>
    
    <?php use_helper('Validation') ?>
    
    <?php use_helper('My') ?>
    
    <?php echo form_tag('user/editProfile', array('class' => 'edit')) ?>
    
        <span class="title"><?php echo __('Edit Profile') ?></span>
        
        <?php echo form_message($sf_request) ?>
        
        <div class="form-row">
            <?php echo form_error('first_name') ?>
            <?php echo label_for('first_name', __('First Name'), array('class' => 'required')) ?>
        	<div class="input-cont">
                <?php echo object_input_tag($sf_user->getProfile(), 'getFirstName') ?>
            </div>
        </div>
        
        <div class="form-row">
            <?php echo form_error('last_name') ?>
            <?php echo label_for('last_name', __('Last Name'), array('class' => 'required')) ?>
        	<div class="input-cont">
                <?php echo object_input_tag($sf_user->getProfile(), 'getLastName') ?>
            </div>
        </div>        
        
        <div class="form-row">
            <?php echo form_error('email') ?>
            <?php echo label_for('email', __('Email'), array('class' => 'required')) ?>
        	<div class="input-cont">
                <?php echo object_input_tag($sf_user->getProfile(), 'getEmail') ?>
            </div>
        </div>                
        
        <div class="form-row">
        	<div class="input-cont">
            <?php echo submit_tag(__('Save')) ?>
        	</div>
        </div>
        
        <?php echo object_input_hidden_tag($sf_user->getProfile(), 'getId') ?>
    
    </form>