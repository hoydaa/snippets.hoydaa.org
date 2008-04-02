<div id="update-tags">
<?php use_helper('Javascript', 'I18N') ?>

<div>
  <p id="indicator-tags" style="display:none;"><?php echo image_tag('indicator.gif') . ' ' . __('receiving records...') ?></p>
</div>
<div class="box">
	<?php echo select_tag(
		'tag_type', 
	    options_for_select(array('cloud' => 'Popular Tags', 'new' => 'New Tags'), $sf_params->get('tag_type')),
	    array(
	        'onchange' => remote_function(
	        array(
	        	'update' => 'update-tags', 
	        	'url' => 'sidebar/tags',
	            'with' => '"tag_type="+value' ,
	            'loading' => "Element.show('indicator-tags');",
	            'complete' => "Element.hide('indicator-tags');"
	        )),
	        'class' => 'box-selector'
	    )) ?>
	<?php foreach($pop_tags as $tag => $pop): ?>
		<?php $text = "<span style='font-size:" . (10 + floor($pop * 10)) . "px;'>" . $tag . "</span>"; ?>
		<?php echo link_to($text, 'sfLucene/search?query=tags:' . $tag) ?>
	<?php endforeach; ?>
</div>