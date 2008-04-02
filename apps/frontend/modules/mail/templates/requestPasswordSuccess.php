<p>Your password is changed!</p>
<p>Dear <?php echo $user->getProfile()->getFullName() ?>,</p>
<p>Your new password is '<?php echo $password ?>', click the link below to go to the login page.</p>
<?php echo link_to('Click here to login', '@sf_guard_signin', array('absolute' => true)) ?>
<p>The Hoydaa Codesnippets Team</p>