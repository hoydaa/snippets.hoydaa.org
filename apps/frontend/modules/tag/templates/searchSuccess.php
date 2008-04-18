<ul>
    <?php foreach($tags as $tag): ?>
		<li id="<?php echo ($prefix ? ($prefix . ' ') : $prefix) . $tag->getTagNormalized() ?>"><?php echo $tag->getTagNormalized() ?></li>
	<?php endforeach; ?>
</ul>
