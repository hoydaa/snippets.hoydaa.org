<?php if ($pager->haveToPaginate()): ?>
<ul class="search-page-numbers">
    <?php if ($pager->getPage() != $pager->getPreviousPage()): ?>
    <li><?php echo link_to(__('Prev'), 'sfLucene/search?query=' . $query . '&page=' . $pager->getPreviousPage() . (($category) ? '&category='.$category : ''), 'class=bookend') ?></li>
    <?php endif ?>
    <?php foreach ($links as $page): ?>
    <?php if ($page == $pager->getPage()): ?>
    <li><span><?php echo $page ?></span></li>
    <?php else: ?>
    <li><?php echo link_to($page, 'sfLucene/search?query=' . $query . '&page=' . $page . (($category) ? '&category='.$category : '')) ?></li>
    <?php endif ?>
    <?php endforeach ?>
    <?php if ($pager->getPage() != $pager->getNextPage()): ?>
    <li><?php echo link_to(__('Next'), 'sfLucene/search?query=' . $query . '&page=' . $pager->getNextPage() . (($category) ? '&category='.$category : ''), 'class=bookend') ?></li>
    <?php endif ?>
</ul>
<?php endif ?>