<?php use_helper('Javascript', 'I18N') ?>

<div class="sidebox">
	<div class="bottom">
		<div class="content">
			<?php echo image_tag('tags.gif') ?><br />
			<?php foreach($pop_tags as $tag => $pop): ?>
			<?php $text = "<span style='font-size:" . (10 + floor($pop * 10)) . "px;'>" . $tag . "</span>"; ?>
			<?php echo link_to($text, 'sfLucene/search?query=tags:' . $tag) ?>
			<?php endforeach; ?>
			<?php echo "<br/>" . __('Display') ?>:
			<?php echo select_tag(
				'tag_type',
				options_for_select(array('cloud' => 'Popular Tags', 'new' => 'New Tags'), $sf_params->get('tag_type')),
				array(
					'onchange' => remote_function(
						array(
							'update' => 'sidebar-tags',
							'url' => 'sidebar/tags',
							'with' => '"tag_type="+value'
						)
					),
					'class' => 'box-selector'
				)
			) ?>
		</div>
	</div>
</div>