<?php echo image_tag('banner.gif') ?>
<br /><br />
<?php foreach ($snippets as $snippet): ?>
<?php include_partial('snippet/show', array('code' => $snippet)) ?>
<div class="hr"></div>
<?php endforeach ?>