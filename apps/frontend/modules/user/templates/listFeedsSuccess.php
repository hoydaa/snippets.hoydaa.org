<?php use_helper('I18N') ?>

<h1><?php echo __('My Feeds') ?></h1>

<?php include_partial('site/message') ?>

<?php if(!$feeds): ?>
	<p><?php echo __('You do not have any feeds defined yet.') ?></p>
<?php endif; ?>
<ol class="search-results">
	<?php foreach($feeds as $feed): ?>
		<li><?php echo $feed->getQuery() ?>  
			<?php echo link_to(__('Delete'), 'user/deleteFeed?id=' . $feed->getId()) ?> | 
			<?php echo link_to(__('View'), 'feed/search?q=' . $feed->getQuery()) ?></li>
	<?php endforeach; ?>
</ol>