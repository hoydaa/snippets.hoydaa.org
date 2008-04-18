<?php if($sf_flash->get('info')): ?>
	<p class="info"><?php echo $sf_flash->get('info') ?></p>
<?php else: ?>
	<p class="error"><?php echo $sf_flash->get('error') ?></p>
<?php endif; ?>