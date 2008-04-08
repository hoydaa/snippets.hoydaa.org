<?php use_helper('Validation', 'I18N') ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
			<h1>code.repository();</h1>
		</div>
	</div>
	<div id="navigation-wrapper">
		<div id="navigation">
		<div style="float: left;">Hede / Hodo / Pede</div>
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
	<div id="search-wrapper">
		<div id="search">
			<?php include_partial('sidebar/searchForm') ?>
		</div>
	</div>
	<div id="content-wrapper">
		<div id="content">
    		<div id="left">
    		    <?php echo $sf_data->getRaw('sf_content') ?>
    		</div>
    		<div id="right">
				<?php include_partial('sidebar/default') ?>
    		</div>
		</div>
	</div>
	<div id="footer-wrapper">
		<div id="footer">
			<p>&copy;2008 www.code-repository.com</p>
			<div style="text-align: center;"><?php echo link_to(image_tag('feed.png') . ' New Snippets', 'feed/newCodes') ?></div>
		</div>
	</div>
	</body>

</html>
