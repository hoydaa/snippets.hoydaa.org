Confirm your email address!
Dear <?php echo $user->getProfile()->getFullName() ?>,
Click the link below to verify your e-mail address and activate your account.
<?php echo $_SERVER['SERVER_NAME'] . '/user/confirmation?key=' . $user->getProfile()->getConfirmation() ?>
Thanks for signing up.
The Hoydaa Codesnippets Team