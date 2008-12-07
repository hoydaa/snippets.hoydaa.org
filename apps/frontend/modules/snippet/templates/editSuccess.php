<?php use_helper('I18N', 'Validation', 'Javascript', 'Cryptographp', 'My') ?>
<?php special_append_to_page_title('Post Snippet') ?>

<h1><?php echo __('Post Snippet') ?></h1>

<?php echo form_tag('snippet/update', array('class' => 'form')) ?>
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
        <?php echo label_for('title', __('Title') . required()) ?>
        <?php echo input_tag('title', $sf_params->get('title')) ?>
        <?php echo form_error('title') ?>
    </div>
    <script type="text/javascript">
	<!--
		function change_size() {
			if($('raw_body').style.width != '95%') {
				$('raw_body').style.width='95%';
				$('raw_body').style.position='absolute';
				$('raw_body').style.top='140px';
				$('raw_body').style.left='10px';
			} else {
				$('raw_body').style.width='';
				$('raw_body').style.position='';
				$('raw_body').style.top='';
				$('raw_body').style.left='';	
			}
		}
	//-->
	</script>
	<?php echo __('Double click to textarea in order to maximize/minimize.'); ?>
    <div class="row">
        <?php echo label_for('raw_body', __('Body') . required()) ?>
        <?php echo textarea_tag('raw_body', $sf_params->get('raw_body'), array('class'=>'body', 'ondblclick' => 'change_size();')) ?>
        <?php echo link_to(image_tag('help.png', array('alt' => __('Markdown Syntax'), 'title' => __('Markdown Syntax'))), 'site/popup?content=markdown', array('popup' => array(__('Markdown Syntax'), 'width=600, height=500, resizable, scrollbars=yes'))) ?>
        <?php echo form_error('raw_body') ?>
    </div>
    <div class="row">
        <?php echo label_for('tags', __('Tags')) ?>
        <?php echo input_auto_complete_tag('tags',  $sf_params->get('tags'), 'tag/autocomplete', array('autocomplete' => 'off'), array('use_style' => 'true', 'tokens' => ',')) ?>
        <?php echo form_error('tags') ?>
    </div>
    <?php if($sf_user->isAuthenticated()): ?>
    <?php if($sf_user->hasGroup('EDITOR')): ?>
    <div class="row">
        <?php echo label_for('managed_content', __('Managed Content')) ?>
        <?php echo checkbox_tag('managed_content', '1', $sf_params->get('managed_content')) ?>
        <?php echo form_error('managed_content') ?>
    </div>
    <?php endif; ?>
    <div class="row">
        <?php echo label_for('draft', __('Draft')) ?>
        <?php echo checkbox_tag('draft', '1', $sf_params->get('draft')) ?>
        <?php echo link_to(image_tag('help.png', array('alt' => __('Draft'), 'title' => __('Draft'))), 'site/popup?content=draft', array('popup' => array(__('Draft'), 'width=300, height=250, resizable, scrollbars=yes'))) ?>
        <?php echo form_error('draft') ?>
    </div>
    <?php endif; ?>
    <?php if (!$sf_params->get('id')): ?>
    <div class="row right_col">
        <?php echo cryptographp_picture() ?><?php echo cryptographp_reload() ?>
    </div>
    <div class="row">
        <?php echo label_for('captcha', __('Type the code shown') . required()) ?>
        <?php echo input_tag('captcha', $sf_params->get('captcha')) ?>
        <?php echo form_error('captcha') ?>
    </div>
    <?php endif; ?>
    <div class="row right_col">
        <?php echo submit_tag(__('Save')) ?>
    </div>
</form>