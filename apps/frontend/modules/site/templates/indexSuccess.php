<?php echo image_tag('banner.gif') ?>
<br /><br />
<ol class="search-results">
    <?php foreach ($snippets as $snippet): ?>
    <li>
        <h1 class="title"><?php echo link_to($snippet->getTitle(), 'snippet/show?id=' . $snippet->getId()); ?></h1>

        <?php include_partial('snippet/show', array('code' => $snippet)) ?>
    </li>
    <?php endforeach ?>
</ol>