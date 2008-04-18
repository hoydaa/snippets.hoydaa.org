    <?php use_helper('Validation', 'I18N') ?>

    <?php use_helper('Object') ?>
    
    <?php use_helper('Validation') ?>
    
    <?php use_helper('Javascript') ?>
    
    <?php use_helper('My') ?>
    
    <?php echo form_remote_tag(
//    	'code/comment?code_id=' . $code_id,
        array(
        	'update' => isset($update_id) ? $update_id : 'update',
        	'url' => 'code/comment?code_id=' . $code_id,
            'loading' => "Element.show('indicator-comment-form')",
            'complete' => "Element.hide('indicator-comment-form');loadComments();"
        ),
        array('class' => 'edit')) ?>
    
        <span class="title"><?php echo __('Add Comment') ?></span>
        
        <?php echo form_message($sf_request) ?>

<div style="height:16px">
  <p id="indicator-comment-form" style="display:none;">
    <?php echo image_tag('indicator.gif') . ' ' . __('posting comment...') ?> 
  </p>
</div>

		<?php if(!$sf_user->isAuthenticated()): ?>
            <div class="form-row">
                <?php echo form_error('name') ?>
            	<?php echo label_for('name', __('Name'), array('class' => 'required')) ?>
            	<div class="input-cont">
                <?php echo input_tag('name', $sf_request->getParameter('name')); ?>
                </div>
            </div>
    
            <div class="form-row">
                <?php echo form_error('email') ?>
            	<?php echo label_for('email', __('Email'), array('class' => 'required')) ?>
            	<div class="input-cont">
                <?php echo input_tag('email', $sf_request->getParameter('email')); ?>
                </div>
            </div>
        <?php else: ?>
        	<?php echo input_hidden_tag('name', $sf_user->getProfile()->getFullName()) ?>
        	<?php echo input_hidden_tag('email', $sf_user->getProfile()->getEmail()) ?>
        <?php endif; ?>
        
        <div class="form-row">
            <?php echo form_error('title') ?>
        	<?php echo label_for('title', __('Title')) ?>
        	<div class="input-cont">
            <?php echo input_tag('title', $sf_request->getParameter('title')); ?>
            </div>
        </div>
        
        <div class="form-row">
            <?php echo form_error('comment') ?>
        	<?php echo label_for('comment', __('Comment'), array('class' => 'required')) ?>
        	<div class="input-cont">
        		<?php include_component('code', 'languageConsole', array('textarea' => 'comment-textarea')) ?>
                <?php echo textarea_tag('comment', $sf_request->getParameter('comment'), array('id' => 'comment-textarea', 'style' => 'width: 300px; height: 200px;')) ?>
            </div>
        </div>
        
        <div class="form-row">
        	<div class="input-cont">
            <?php echo submit_tag(__('Save')) ?>
        	</div>
        </div>
    
    </form>