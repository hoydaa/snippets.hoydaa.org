<?php if($sf_user->isAuthenticated()): ?>
	<?php include_component('sidebar', 'user') ?>
<?php endif; ?>
<?php include_component('sidebar', 'most') ?>
<?php include_component('sidebar', 'tags') ?>