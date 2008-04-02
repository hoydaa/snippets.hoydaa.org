<div id="update-most">
<?php use_helper('Date', 'I18N', 'My') ?>

<?php use_helper('Javascript') ?>

<div>
  <p id="indicator-most" style="display:none;">
    <?php echo image_tag('indicator.gif') . ' ' . __('receiving records...') ?> 
  </p>
</div>
<div class="box">
	<?php echo select_tag(
		'most', 
	    options_for_select(array('new' => 'New Snippets', 'high' => 'Highest Rated Snippets', 'disc' => 'Most Discussed Snippets'), $sf_params->get('most')),
	    array(
	        'onchange' => remote_function(
	        array(
	        	'update' => 'update-most', 
	        	'url' => 'sidebar/most',
	            'with' => '"most="+value' ,
	            'loading' => "Element.show('indicator-most');",
	            'complete' => "Element.hide('indicator-most');"
	        )),
	        'class' => 'box-selector'
	    )) ?>
	<?php foreach($new_codes as $code): ?>
		<p><?php echo link_to($code->getTitle(), 'code/show?id=' . $code->getId()); ?></p>
		<p style="text-align: right; font-style: italic; font-size: 8px;">
		    <?php echo '[ ' . 
		        link_to($code->getContributor(), 'sfLucene/search?query=contributor:' . $code->getContributor()) . ', ' .
		        ' ' . link_to_languages($code->getLanguages()) . ', ' . 
		        format_date($code->getCreatedAt()) . ' ]' ?>
		</p>
	<?php endforeach; ?>
</div>
</div>