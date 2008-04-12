<?php use_helper('Validation', 'I18N') ?>

<!DOCTYPE html PUBLIC
	"-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<?php include_http_metas() ?>
		<?php include_metas() ?>
		<?php include_title() ?>
		<link rel="shortcut icon" href="/favicon.ico" />
	</head>
	<body>
		<div id="header-wrapper">
			<div id="header">
				<ul class="menu">
					<li><?php echo link_to(__('Post Code'), 'code/edit') ?></li>
					<?php if(!$sf_user->isAuthenticated()): ?>
						<li><?php echo link_to(__('Login'), '@sf_guard_signin') ?></li>
						<li><?php echo link_to(__('Register'), 'user/register') ?></li>
					<?php else: ?>
						<li><?php echo link_to($sf_user->getUsername() . "'s " . __('Profile'), 'user/editProfile') ?></li>
						<li><?php echo link_to(__('Logout'), '@sf_guard_signout') ?></li>
					<?php endif; ?>
				</ul>
			</div>
		</div>
		<div id="bar-wrapper">
			<div id=bar>
				<?php include_partial('sidebar/searchForm') ?>
			</div>
		</div>
		<div id="main-wrapper">
			<div id="main">
				<div id="sidebar">
					<?php if($sf_user->isAuthenticated()): ?>
					<div id="sidebar-user">
						<?php include_component('sidebar', 'user') ?>
					</div>
					<br />
					<?php endif; ?>
					<div id="sidebar-snippets">
						<?php include_component('sidebar', 'most') ?>
					</div>
					<br />
					<div id="sidebar-tags">
						<?php include_component('sidebar', 'tags') ?>
					</div>
				</div>
				<div id="content">
					<?php echo $sf_data->getRaw('sf_content') ?>
				</div>
			</div>
		</div>
		<div id="footer-wrapper">
			<div id="footer">
				<p>Copyright &copy; <?php echo date("Y") ?> Hoydaa Inc. All rights reserved.</p>
				<p><?php echo link_to(__('New Snippets'), 'feed/newCodes', 'class=feed') ?></p>
			</div>
		</div>
	</body>
</html>