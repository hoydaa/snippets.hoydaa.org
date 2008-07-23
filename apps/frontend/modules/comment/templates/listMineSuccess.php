<?php use_helper('I18N', 'Date', 'My') ?>

<h1><?php echo __('My Comments') ?></h1>

<ol start="<?php echo $pager->getFirstIndice() ?>" class="search-results">
    <?php foreach ($pager->getResults() as $comment): ?>
    <li>
        <h2><?php echo link_to($comment->getSnippet()->getTitle(), 'snippet/show?id=' . $comment->getSnippet()->getId() . '#comment' . $comment->getId()) ?></h2>
        <?php echo comment_posted_by($comment) ?>
        <p><?php echo $comment->getSummary() ?></p>
    </li>
    <?php endforeach ?>
</ol>

<?php if ($pager->haveToPaginate()): ?>
<ul class="search-page-numbers">
    <?php if ($pager->getPage() != $pager->getPreviousPage()): ?>
    <li><?php echo link_to(__('Prev'), 'comment/listMine?page=' . $pager->getPreviousPage()) ?></li>
    <?php endif; ?>
    <?php foreach ($pager->getLinks() as $page): ?>
    <li>
        <?php if ($page == $pager->getPage()): ?>
        <span><?php echo $page ?></span>
        <?php else: ?>
        <?php echo link_to($page, 'comment/listMine?page=' . $page) ?>
        <?php endif; ?>
    </li>
    <?php endforeach; ?>
    <?php if ($pager->getPage() != $pager->getNextPage()): ?>
    <li><?php echo link_to(__('Next'), 'comment/listMine?page=' . $pager->getNextPage()) ?></li>
    <?php endif; ?>
</ul>
<?php endif; ?>