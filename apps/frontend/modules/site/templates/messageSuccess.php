<?php if($sf_flash->get('message')): ?>
	<p class="message"><?php echo $sf_flash->get('message') ?></p>
<?php else: ?>
	<p class="error"><?php echo $sf_flash->get('error') ?></p>
<?php endif; ?>