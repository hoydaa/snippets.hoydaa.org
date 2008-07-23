<ol start="<?php echo $pager->getFirstIndice() ?>" class="search-results">
    <?php foreach ($pager->getResults() as $result): ?>
    <li>
        <?php include_partial('snippet/searchResult', array('result' => $result)) ?>
    </li>
    <?php endforeach ?>
</ol>

<div class="right-aligned"><?php include_partial('sfLucene/pageSize') ?></div>
<?php include_partial('sfLucene/pagerNavigation', array('pager' => $pager)) ?>