<p class="message">
Dear <?php echo $user->getProfile()->getFullName() ?>,<br/>
We sent a confirmation email to your email address; <?php echo $user->getProfile()->getEmail() ?>, 
please go to your mailbox and follow the instructions in order to activate your account.<br/>
</p>