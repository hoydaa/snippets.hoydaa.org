	<script language="javascript">
		function updateTags(text, li) {
			document.getElementsByName('tags')[0].value = li.id;
		}
		
		function findPosX(obj)
		{
			var curleft = 0;
			if (document.getElementById || document.all)
			{
				while (obj.offsetParent)
				{
					curleft += obj.offsetLeft;
					obj = obj.offsetParent;
				}
			}
			else if (document.layers)
				curleft += obj.x;
			return curleft;
		}

		function findPosY(obj)
		{
			var curtop = 0;
			if (document.getElementById || document.all)
			{
				while (obj.offsetParent)
				{
					curtop += obj.offsetTop;
					obj = obj.offsetParent;
				}
			}
			else if (document.layers)
				curtop += obj.y;
			return curtop;
		}		
	</script>

    <?php use_helper('Validation', 'I18N') ?>

    <?php use_helper('Object') ?>
    
    <?php use_helper('Validation') ?>
    
    <?php use_helper('Javascript') ?>
    
    <?php use_helper('My') ?>
    
    <?php echo form_tag('code/edit', array('class' => 'edit')) ?>
    
        <span class="title"><?php echo __('Add & Edit Code') ?></span>
        
        <?php echo form_message($sf_request) ?>

		<?php if(!$sf_user->isAuthenticated()): ?>
            <div class="form-row">
                <?php echo form_error('name') ?>
            	<?php echo label_for('name', __('Name'), array('class' => 'required')) ?>
            	<div class="input-cont">
                <?php echo object_input_tag($code, 'getName'); ?>
                </div>
            </div>
    
            <div class="form-row">
                <?php echo form_error('email') ?>
            	<?php echo label_for('email', __('Email'), array('class' => 'required')) ?>
            	<div class="input-cont">
                <?php echo object_input_tag($code, 'getEmail'); ?>
                </div>
            </div>
        <?php else: ?>
        	<?php echo input_hidden_tag('name', $sf_user->getProfile()->getFullName()) ?>
        	<?php echo input_hidden_tag('email', $sf_user->getProfile()->getEmail()) ?>
        <?php endif; ?>
        
        <div class="form-row">
            <?php echo form_error('code') ?>
                <?php echo link_to(label_for('code', __('Code'), array('class' => 'required')), '#', array(
             		'onmouseover' => remote_function(
	                    array(
	                        'method' => 'post',
	                        'contentType' => 'application/x-www-form-urlencoded',
	        				'update' => 'code-div', 
	        				'url' => 'sidebar/highlight',
	            			'with' => '"code="+encodeURIComponent($("code-textarea").value)+"&language="+$("code_language_id").options[$("code_language_id").selectedIndex].value',
	            			'loading' => "$('code-div').innerHTML='Please wait...';Element.show('code-div');",
	            			'complete' => "Element.hide('indicator-highlight');"
	                    )),
	            	'onmouseout' => "Element.hide('code-div');"
                )) ?>            
        	<div class="input-cont">
        		<?php include_component('sidebar', 'languageConsole', array('textarea' => 'code-textarea')) ?>
        		<div id="code-div" style="display: none;" class="code_snippet">
        		</div>
                <?php echo object_textarea_tag($code, 'getCode', array('id' => 'code-textarea')) ?>
            <span id="indicator-highlight" style="display: none;"> Please wait...</span>
            </div>
            <script language="javascript">
            	$("code-div").style.top = findPosY($("code-textarea"));
            	$("code-div").style.left = findPosX($("code-textarea"));
            </script>
        </div>
        
        <div class="form-row">
        	<?php echo form_error('title') ?>
        	<?php echo label_for('title', __('Title'), array('class' => 'required')) ?>
        	<div class="input-cont">
            <?php echo object_input_tag($code, 'getTitle') ?>
            </div>
        </div>
        
        <div class="form-row">
            <?php echo form_error('description') ?>
        	<?php echo label_for('description', __('Description')) ?>
        	<div class="input-cont">
            <?php echo object_input_tag($code, 'getDescription') ?>
            </div>
        </div>
        
        <div class="form-row">
            <?php echo form_error('tags') ?>
        	<?php echo label_for('tags', __('Tags')) ?>
        	<div class="input-cont">
                <?php echo input_auto_complete_tag('tags', $code->getTags(), 'sidebar/searchTag', array('autocomplete'=>'off', 'size'=>'40'), array('use_style'=>'true', 'after_update_element'=>'updateTags')) ?>
            </div>
        </div>        
        
        <div class="form-row">
        	<div class="input-cont">
            <?php echo submit_tag(__('Save')) ?>
        	</div>
        </div>
        
        <?php echo object_input_hidden_tag($code, 'getId') ?>
    
    </form>
    
    <div class="code_snippet" id="hede">
<div>
    <div class="line_numbers">1<br>2<br>3<br>4<br>5<br>6<br>7</div>
    <div style="float:left;">
        <span class="keyword">public</span><span>&nbsp;</span><span class="keyword">class</span><span>&nbsp;</span><span>Deneme</span><span>&nbsp;</span><span>{</span><span>
            <br>&nbsp;&nbsp;&nbsp;&nbsp;</span><span class="keyword">private</span><span>&nbsp;</span><span class="keyword">int</span><span>&nbsp;</span><span>a</span><span>&nbsp;</span><span>=</span><span>&nbsp;</span><span>0</span><span>;</span><span>
            <br>
            <br>&nbsp;&nbsp;&nbsp;&nbsp;</span><span class="keyword">public</span><span>&nbsp;</span><span>Deneme</span><span>(</span><span class="keyword">int</span><span>&nbsp;</span><span>a</span><span>)</span><span>&nbsp;</span><span>{</span><span>
            <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span class="keyword">this</span><span>.</span><span>a</span><span>&nbsp;</span><span>=</span><span>&nbsp;</span><span>a</span><span>;</span><span>
            <br>&nbsp;&nbsp;&nbsp;&nbsp;</span><span>}</span><span>
            <br>
        </span><span>}</span>
    </div>
</div>    
    </div>