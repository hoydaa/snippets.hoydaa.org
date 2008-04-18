<?php use_helper('Date', 'I18N', 'My', 'Javascript') ?>

<div class="sidebox">
	<div class="bottom">
		<div class="content">
			<?php echo image_tag('snippets.gif') ?><br />
			<ul>
				<?php foreach ($snippets as $snippet): ?>
				<li>
					<?php echo link_to($snippet->getTitle(), 'code/show?id='.$snippet->getId()); ?><br />
					<?php include_partial('code/createdBy', array('code' => $snippet)) ?>
				</li>
				<?php endforeach; ?>
			</ul>
			<?php echo __('Display') ?>:
			<?php echo select_tag(
				'most',
				options_for_select(
					array(
						'new' => 'New Snippets',
						'high' => 'Highest Rated Snippets',
						'disc' => 'Most Discussed Snippets'
					),
					$sf_params->get('most')
				),
				array(
					'onchange' => remote_function(
						array(
							'update' => 'sidebar-snippets',
							'url' => 'sidebar/most',
							'with' => '"most="+value'
						)
					),
				)
			) ?>
		</div>
	</div>
</div>