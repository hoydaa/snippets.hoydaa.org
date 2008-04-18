<?php use_helper('I18N', 'Javascript') ?>

<div class="related">
	<span class="title"><?php echo $code->getTitle() ?></span>
	<div class="code-block">
		<div class="code-info"><?php include_partial('code/createdBy', array('code' => $code)) ?></div>	
		<div class="code-desc">"<?php echo $code->getDescription() ?>"</div>
		<div class="code-code"><?php echo $code->getCodeHtmlized() ?></div>
	</div>
	<div id="rater-update">
        <?php include_partial('code/rater', array(
			'rate_max' => 10, 
			'rate_avg' => $code->getAverageRating(), 
			'rater_width' => 200,
    		'rater_url' => 'code/rate?code_id=' . $code->getId(),
    		'rater_update' => 'rater-update',
    		'rating_count' => $code->countRatings()
        )); ?>
	</div>
</div>
<br/>

<?php include_partial('code/javascript', array('code' => $code)) ?>
<br/>

<div id="comment-list-container">
<?php include_partial('code/comments', array('code' => $code)) ?>
</div>
<br/>

<div id="comment-form-container">
<?php include_partial('code/commentForm', array(
	'code_id' => $code->getId(), 
	'update_id' => 'comment-form-container')) ?>
</div>
<br/>

<?php include_partial('code/relatedSnippets', array('rel_codes'=>$rel_codes)) ?>
<br/>

<script language="javascript">
	//Event.observe(window, 'load', loadComments());
	function loadComments() {
		<?php echo remote_function(
		    array(
		        'update' => 'comment-list-container',
		        'url' => 'code/commentList?code_id=' . $code->getId()
		    )
		) ?>
	}
</script>