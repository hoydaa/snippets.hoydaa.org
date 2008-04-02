<?php use_helper('I18N') ?>

<?php if(sizeof($rel_codes) > 0): ?>
<div class="related">
	<span class="title">
		<?php echo __('Related Snippets') ?>
	</span>
	<ul class="related-list">
		<?php foreach($rel_codes as $code): ?>
			<li><?php include_partial('code/createdBy', array('code' => $code)) ?></li>
		<?php endforeach; ?>
	</ul>
</div>
<?php endif; ?>