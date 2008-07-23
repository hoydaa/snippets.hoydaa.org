<?php

$sf_controller = $sf_context->getController();
$params = $sf_request->getParameterHolder()->getAll();

?>

<?php if ($pager->haveToPaginate()): ?>
<ul class="search-page-numbers">
    <?php if ($pager->getPage() != $pager->getPreviousPage()): ?>
    <li><a href="<?php echo $sf_controller->genUrl(array_merge($params, array('page' => $pager->getPreviousPage()))) ?>" class="bookend"><?php echo __('Prev') ?></a></li>
    <?php endif ?>

    <?php foreach ($pager->getLinks() as $page): ?>
    <?php if ($page == $pager->getPage()): ?>
    <li><span><?php echo $page ?></span></li>
    <?php else: ?>
    <li><a href="<?php echo $sf_controller->genUrl(array_merge($params, array('page' => $page))) ?>" class="bookend"><?php echo $page ?></a></li>
    <?php endif ?>
    <?php endforeach ?>

    <?php if ($pager->getPage() != $pager->getNextPage()): ?>
    <li><a href="<?php echo $sf_controller->genUrl(array_merge($params, array('page' => $pager->getNextPage()))) ?>" class="bookend"><?php echo __('Next') ?></a></li>
    <?php endif ?>
</ul>
<?php endif ?>