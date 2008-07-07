<?php use_helper('I18N', 'Validation', 'Javascript') ?>

<?php echo form_tag('snippet/update') ?>
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
        <?php echo label_for('title', __('Title')) ?>
        <?php echo input_tag('title', $sf_params->get('title')) ?>
        <?php echo form_error('title') ?>
    </div>
    <div class="row">
        <?php echo label_for('description', __('Description')) ?>
        <?php echo textarea_tag('description', $sf_params->get('description')) ?>
        <?php echo form_error('description') ?>            
    </div>
    <div class="row">
        <?php echo label_for('body', __('Snippet')) ?>
        <?php echo textarea_tag('body', $sf_params->get('body'), 'class=snippet') ?>
        <?php echo form_error('body') ?>
    </div>
    <div class="row">
        <?php echo label_for('tags', __('Tags')) ?>
        <?php echo input_auto_complete_tag('tags',  $sf_params->get('tags'), 'tag/autocomplete', array('autocomplete' => 'off'), array('use_style' => 'true', 'tokens' => ',')) ?>
        <?php echo form_error('tags') ?>
    </div>
    <?php if($sf_user->isAuthenticated() && $sf_user->hasGroup('EDITOR')): ?>
    <div class="row">
        <?php echo label_for('managed_content', __('Managed Content')) ?>
        <?php echo checkbox_tag('managed_content', '1', $sf_params->get('managed_content')) ?>
        <?php echo form_error('managed_content') ?>
    </div>
    <?php endif; ?>
    <div class="button-panel">
        <?php echo submit_tag(__('Save')) ?>
    </div>
</form>