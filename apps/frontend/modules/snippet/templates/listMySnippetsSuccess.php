<?php use_helper('I18N', 'Date') ?>

<h1><?php echo __('Your Snippets') ?></h1>

<?php include_partial('snippet/list', array('pager' => $pager)) ?>

<?php if ($pager->haveToPaginate()): ?>
<ul class="search-page-numbers">
    <?php if ($pager->getPage() != $pager->getPreviousPage()): ?>
    <li><?php echo link_to(__('Prev'), 'snippet/listMySnippets?page=' . $pager->getPreviousPage()) ?></li>
    <?php endif; ?>
    <?php foreach ($pager->getLinks() as $page): ?>
    <li>
        <?php if ($page == $pager->getPage()): ?>
        <span><?php echo $page ?></span>
        <?php else: ?>
        <?php echo link_to($page, 'snippet/listMySnippets?page=' . $page) ?>
        <?php endif; ?>
    </li>
    <?php endforeach; ?>
    <?php if ($pager->getPage() != $pager->getNextPage()): ?>
    <li><?php echo link_to(__('Next'), 'snippet/listMySnippets?page=' . $pager->getNextPage()) ?></li>
    <?php endif; ?>
</ul>
<?php endif; ?>