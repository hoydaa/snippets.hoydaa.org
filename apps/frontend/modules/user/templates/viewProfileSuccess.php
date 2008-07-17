<?php use_helper('I18N', 'Date') ?>

<h1 class="title"><?php echo $user->getUsername() . __('\'s profile') ?></h1>
<?php if ($user->hasGroup('EDITOR')): ?>
<?php echo image_tag('shield.png', array('alt' => __('Editor'), 'title' => __('Editor'))) ?>
<?php endif; ?>

<p><?php echo __('Posted %1% snippet(s) since %2%.', array('%1%' => $snippet_count, '%2%' => format_date($user->getCreatedAt()))) ?></p>

<ol start="<?php echo $pager->getFirstIndice() ?>" class="search-results">
    <?php foreach ($pager->getResults() as $result): ?>
    <li>
        <?php include_partial('snippet/searchResult', array('result' => $result)) ?>
    </li>
    <?php endforeach ?>
</ol>