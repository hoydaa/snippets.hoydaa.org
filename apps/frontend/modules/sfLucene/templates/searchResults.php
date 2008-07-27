<?php use_helper('sfLucene', 'I18N') ?>

<h1><?php echo __('Search Results') ?></h1>

<p><?php echo __('The following results matched your query:') ?></p>

<ol start="<?php echo $pager->getFirstIndice() ?>" class="search-results">
    <?php foreach ($pager->getResults() as $result): ?>
    <li><?php include_search_result($result, $query) ?></li>
    <?php endforeach ?>
</ol>

<div class="right-aligned"><?php include_partial('sfLucene/pageSize') ?></div>
<?php include_search_pager($pager, sfConfig::get('app_lucene_pager_radius')) ?>