<ol start="<?php echo $pager->getFirstIndice() ?>" class="search-results">
    <?php foreach ($pager->getResults() as $result): ?>
    <li>
        <?php include_partial('snippet/searchResult', array('result' => $result)) ?>
    </li>
    <?php endforeach ?>
</ol>
<?php include_partial('sfLucene/pageSizeSwitcher') ?>