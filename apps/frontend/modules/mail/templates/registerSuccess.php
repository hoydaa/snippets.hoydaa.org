<p>Confirm your email address!</p>
<p>Dear <?php echo $user->getProfile()->getFullName() ?>,</p>
<p>Click the link below to verify your e-mail address and activate your account.</p>
<p><?php echo link_to('Verify my account', 
	'user/confirmation?key=' . $user->getProfile()->getConfirmation(), array('absolute' => true)) ?></p>
<p>Thanks for signing up.</p>
<p>The Hoydaa Codesnippets Team</p>