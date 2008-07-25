<?php echo image_tag('banner.gif') ?>
<br /><br />
<?php foreach ($snippets as $snippet): ?>
<h1 class="title"><?php echo link_to($snippet->getTitle(), 'snippet/show?id=' . $snippet->getId()); ?></h1>
<?php include_partial('snippet/show', array('code' => $snippet)) ?>
<div class="hr"></div>
<?php endforeach ?>