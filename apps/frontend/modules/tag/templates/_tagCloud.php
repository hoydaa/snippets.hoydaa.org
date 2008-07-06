<div class="sidebox">
	<div class="bottom">
		<div class="content">
			<?php echo image_tag('tags.gif') ?><br />
			<ul id="tag_cloud">
			    <?php foreach($tags as $tag => $rank): ?>
			    <li class="rank_<?php echo $rank ?>"><?php echo link_to($tag, 'tag/show?tag=' . $tag) ?></li>
			    <?php endforeach; ?>
			</ul>
		</div>
	</div>
</div>