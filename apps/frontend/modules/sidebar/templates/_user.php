<?php use_helper('I18N') ?>

<div class="box">
	<h3><?php echo __('Welcome') ?>, <?php echo $sf_user->getGuardUser()->getUsername() ?></h3>
	<p>You have <?php echo link_to($user_code_count, 'sfLucene/search?query=contributor:' . $sf_user->getGuardUser()->getUsername()) ?> post(s).</p>
	<p>You have <?php echo link_to($user_comment_count, 'code/list?job=comment') ?> comment(s).</p>
	<p>You have voted <?php echo link_to($user_rating_count, 'code/list?job=rating') ?> post(s).</p>
	<p><?php echo link_to(__('Change password'), 'user/changePassword') ?></p>
</div>