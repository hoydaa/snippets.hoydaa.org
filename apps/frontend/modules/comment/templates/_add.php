<?php use_helper('I18N', 'Validation', 'Javascript', 'Cryptographp', 'My') ?>

<?php echo form_remote_tag(array(
  'url' => 'comment/add',
  'update' => array('success' => 'new_comment', 'failure' => 'comment_form-wrapper'),
  'success' => "Element.show('new_comment');Element.hide('comment_form-wrapper');"
)) ?>
  <?php echo input_hidden_tag('id', $sf_params->get('id')) ?>
  <?php if(!$sf_user->isAuthenticated()): ?>
  <div class="row">
    <?php echo label_for('name', __('Name') . required()) ?>
    <?php echo input_tag('name', $sf_params->get('name')) ?>
    <?php echo form_error('name') ?>
  </div>
  <div class="row">
    <?php echo label_for('email', __('Email') . required()) ?>
    <?php echo input_tag('email', $sf_params->get('email')) ?>
    <?php echo form_error('email') ?>
  </div>
  <?php endif; ?>
  <div class="row">
    <?php echo label_for('raw_body', __('Body') . required()) ?>
    <?php echo textarea_tag('raw_body', $sf_params->get('raw_body')) ?>
    <?php echo link_to(image_tag('help.png', array('alt' => __('Markdown Syntax'), 'title' => __('Markdown Syntax'))), 'site?content=markdown', array('popup' => array(__('Markdown Syntax'), 'width=600, height=500, resizable, scrollbars=yes'))) ?>
    <?php echo form_error('raw_body') ?>            
  </div>
  <div class="row right_col">
    <?php echo cryptographp_picture() ?><?php echo cryptographp_reload() ?>
  </div>
  <div class="row">
    <?php echo label_for('captcha', __('Type the code shown') . required()) ?>
    <?php echo input_tag('captcha', $sf_params->get('captcha')) ?>
    <?php echo form_error('captcha') ?>
  </div>
  <div class="row right_col">
    <?php echo submit_tag(__('Save')) ?>
  </div>
</form>