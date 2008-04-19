<?php use_helper('I18N', 'Object', 'Validation', 'Javascript') ?>

<script language="javascript">
    function updateTags(text, li) {
        document.getElementsByName('tags')[0].value = li.id;
    }
</script>

<?php echo form_tag('code/edit') ?>
    <?php echo object_input_hidden_tag($code, 'getId') ?>
    <?php if(!$sf_user->isAuthenticated()): ?>
    <div class="row">
        <?php echo label_for('name', __('Name'), array('class' => 'required')) ?>
        <?php echo object_input_tag($code, 'getName'); ?>
        <?php echo form_error('name') ?>
    </div>
    <div class="row">
        <?php echo label_for('email', __('Email'), array('class' => 'required')) ?>
        <?php echo object_input_tag($code, 'getEmail'); ?>
        <?php echo form_error('email') ?>
    </div>
    <?php else: ?>
        <?php echo input_hidden_tag('name', $sf_user->getProfile()->getFullName()) ?>
        <?php echo input_hidden_tag('email', $sf_user->getProfile()->getEmail()) ?>
    <?php endif; ?>
    <div class="row">
        <?php echo link_to(label_for('code', __('Code'), array('class' => 'required')), '#', array(
            'onmouseover' => remote_function(
                array(
                    'method' => 'post',
                    'contentType' => 'application/x-www-form-urlencoded',
                    'update' => 'code-div',
                    'url' => 'code/highlight',
                    'with' => '"code="+encodeURIComponent($("code-textarea").value)',
                    'loading' => "$('code-div').innerHTML='Please wait...';Element.show('code-div');",
                )),
                'onmouseout' => "Element.hide('code-div');"
        )) ?>
        <?php include_component('code', 'languageConsole', array('textarea' => 'code-textarea')) ?>
        <div id="code-div" style="display: none;"></div>
        <?php echo object_textarea_tag($code, 'getCode', array('id' => 'code-textarea')) ?>
        <?php echo form_error('code') ?>
        <script language="javascript">
            $("code-div").style.top = findPosY($("code-textarea"));
            $("code-div").style.left = findPosX($("code-textarea"));
        </script>
    </div>
    <div class="row">
        <?php echo label_for('title', __('Title'), array('class' => 'required')) ?>
        <?php echo object_input_tag($code, 'getTitle') ?>
        <?php echo form_error('title') ?>
    </div>
    <div class="row">
        <?php echo label_for('description', __('Description')) ?>
        <?php echo object_input_tag($code, 'getDescription') ?>
        <?php echo form_error('description') ?>            
    </div>
    <div class="row">
        <?php echo label_for('tags', __('Tags')) ?>
        <?php echo input_auto_complete_tag('tags', $code->getTags(), 'tag/search', array('autocomplete'=>'off', 'size'=>'40'), array('use_style'=>'true', 'after_update_element'=>'updateTags')) ?>
        <?php echo form_error('tags') ?>
    </div>
    <div class="button-panel">
        <?php echo submit_tag(__('Save')) ?>
    </div>
</form>