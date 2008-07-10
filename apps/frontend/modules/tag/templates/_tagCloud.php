<?php use_helper('Javascript') ?>
<div class="sidebox">
	<div class="bottom">
		<div class="content">
			<?php echo link_to_blind('tag_cloud_box', image_tag('tags.gif')) ?>
		</div>
		<div class="content" id="tag_cloud_box">
			<ul id="tag_cloud">
			    <?php foreach($tags as $tag => $rank): ?>
			    <li class="rank_<?php echo $rank ?>"><?php echo link_to($tag, 'tag/show?tag=' . $tag) ?></li>
			    <?php endforeach; ?>
			</ul>
		</div>
	</div>
</div>