<?php use_helper('I18N', 'Validation', 'Javascript') ?>

<?php echo form_remote_tag(array(
  'url' => 'comment/add',
  'update' => array('success' => 'new_comment', 'failure' => 'comment_form-wrapper'),
  'success' => "Element.show('new_comment');Element.hide('comment_form-wrapper');"
)) ?>
  <?php echo input_hidden_tag('id', $sf_params->get('id')) ?>
  <?php if(!$sf_user->isAuthenticated()): ?>
  <div class="row">
    <?php echo label_for('name', __('Name')) ?>
    <?php echo input_tag('name', $sf_params->get('name')) ?>
    <?php echo form_error('name') ?>
  </div>
  <div class="row">
    <?php echo label_for('email', __('Email')) ?>
    <?php echo input_tag('email', $sf_params->get('email')) ?>
    <?php echo form_error('email') ?>
  </div>
  <?php endif; ?>
  <div class="row">
    <?php echo label_for('body', __('Comment')) ?>
    <?php echo textarea_tag('body', $sf_params->get('body')) ?>
    <?php echo form_error('body') ?>            
  </div>
  <div class="button-panel">
    <?php echo submit_tag(__('Save')) ?>
  </div>
</form>