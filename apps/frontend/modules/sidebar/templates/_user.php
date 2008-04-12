<?php use_helper('I18N') ?>

<div class="sidebox">
	<div class="bottom">
		<div class="content">
			<?php echo image_tag('user.gif') ?><br />
			<p><?php echo __('Welcome') ?>, <?php echo $sf_user->getGuardUser()->getUsername() ?></p>
			You have <?php echo link_to($user_code_count, 'sfLucene/search?query=contributor:' . $sf_user->getGuardUser()->getUsername()) ?> post(s).<br /><br />
			You have <?php echo link_to($user_comment_count, 'code/list?job=comment') ?> comment(s).<br /><br />
			You have voted <?php echo link_to($user_rating_count, 'code/list?job=rating') ?> post(s).<br /><br />
			<?php echo link_to(__('Change password'), 'user/changePassword') ?>
		</div>
	</div>
</div>