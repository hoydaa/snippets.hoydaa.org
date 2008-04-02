    <?php use_helper('Validation', 'I18N') ?>

    <?php use_helper('Object') ?>
    
    <?php use_helper('Validation') ?>
    
    <?php use_helper('My') ?>
    
    <?php echo form_tag('user/requestPassword', array('class' => 'edit')) ?>
    
        <span class="title"><?php echo __('Request Password') ?></span>
        
        <?php echo form_message($sf_request) ?>
        
        <div class="form-row">
            <?php echo form_error('username') ?>
            <?php echo label_for('username', __('Username'), array('class' => 'required')) ?>
        	<div class="input-cont">
                <?php echo input_tag('username') ?>
            </div>
        </div>
        
        <div class="form-row">
            <?php echo form_error('email') ?>
            <?php echo label_for('email', __('Email'), array('class' => 'required')) ?>
        	<div class="input-cont">
                <?php echo input_tag('email') ?>
            </div>
        </div>        
        
        <div class="form-row">
        	<div class="input-cont">
            <?php echo submit_tag(__('Submit')) ?>
        	</div>
        </div>
    
    </form>