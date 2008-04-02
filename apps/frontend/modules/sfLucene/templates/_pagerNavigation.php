<?php
/**
 * @package sfLucenePlugin
 * @subpackage Module
 * @author Carl Vondrick <carlv@carlsoft.net>
 */
?>

<?php if ($pager->haveToPaginate()): ?>
    <?php if ($pager->getPage() != $pager->getPreviousPage()): ?>
      <?php echo link_to(image_tag('/sf/sf_admin/images/previous.png', 'align=absmiddle'), 'sfLucene/search?query=' . $query . '&page=' . $pager->getPreviousPage(), 'class=bookend') ?>
    <?php endif ?>

    <?php foreach ($links as $page): ?>
      <?php if ($page == $pager->getPage()): ?>
        <strong><?php echo $page ?></strong>
      <?php else: ?>
        <?php echo link_to($page, 'sfLucene/search?query=' . $query . '&page=' . $page) ?>
      <?php endif ?>
    <?php endforeach ?>

    <?php if ($pager->getPage() != $pager->getNextPage()): ?>
      <?php echo link_to(image_tag('/sf/sf_admin/images/next.png', 'align=absmiddle'), 'sfLucene/search?query=' . $query . '&page=' . $pager->getNextPage(), 'class=bookend') ?>
    <?php endif ?>

<?php endif ?>