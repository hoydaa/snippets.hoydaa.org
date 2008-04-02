<?php if(isset($user)): ?>
	<p>Dear <?php echo $user->getProfile()->getFullName() ?>,</p>
	<p>Your account is activated, click <?php echo link_to('here', '@sf_guard_signin') ?> to continue to login form.</p>
<?php else: ?>
	<p>Invalid or no confirmation key is provided. If you are using the link we sent to your email address, please send an e-mail to administrator.</p>
<?php endif; ?>