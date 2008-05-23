<?php use_helper('Date', 'I18N', 'My', 'jQuery') ?>

<div class="sidebox">
	<div class="bottom">
		<div class="content">
			<?php echo image_tag('snippets.gif') ?><br />
			<ol>
				<?php foreach ($snippets as $snippet): ?>
				<li>
					<h3><?php echo link_to($snippet->getTitle(), 'code/show?id='.$snippet->getId(), 'class=title'); ?></h3>
					<?php include_partial('code/createdBy', array('code' => $snippet)) ?>
				</li>
				<?php endforeach; ?>
			</ol>
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
					'onchange' => jq_remote_function(
						array(
							'update' => 'sidebar-snippets',
							'url' => 'code/most',
							'with' => '"most="+value'
						)
					),
				)
			) ?>
		</div>
	</div>
</div>