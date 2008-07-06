<?php use_helper('I18N', 'Date') ?>

<h1><?php echo __('Snippets') ?></h1>

<ol start="<?php echo $pager->getFirstIndice() ?>" class="search-results">
    <?php foreach ($pager->getResults() as $result): ?>
    <li>
        <?php include_partial('snippet/searchResult', array('result' => $result)) ?>
        <?php echo link_to(__('Edit'), 'snippet/edit?id='.$result->getId()) ?>
    </li>
    <?php endforeach ?>
</ol>