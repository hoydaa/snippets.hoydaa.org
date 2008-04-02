<?php use_helper('Javascript'); ?>

<script language="javascript">
	function addTag(tagname) {
		$('<?php echo $textarea ?>').focus();
		$('<?php echo $textarea ?>').value += '\n<' + tagname + '></' + tagname + '>';
	}
</script>
<div>
<?php foreach($languages as $language): ?>
	<a href="#sf_comment_form" onclick="addTag('<?php echo $language->getTag() . '-snippet' ?>');"><?php echo "&lt;" . $language->getTag() . "&gt;" ?></a>
<?php endforeach; ?>
<a href="#sf_comment_form" onclick="addTag('<?php echo 'other' . '-snippet' ?>');"><?php echo "&lt;" . 'other' . "&gt;" ?></a>
<p>Use the helpers above to generate snippet blocks and put your code inside them.</p>
</div>