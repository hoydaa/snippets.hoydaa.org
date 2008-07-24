<?php use_helper('I18N') ?>

<h1><?php echo __('All Languages') ?></h1>

<ul class="tag_cloud all_tags">
  <?php foreach($languages as $language): ?>
    <li class="rank_<?php echo $language['rank'] ?>"><?php echo link_to($language['language'], 'language/show?language=' . $language['language'], array('title' => __(":count snippet(s) with ':language' code", array(':count' => $language['count'], ':language' => $language['language'])))) ?></li>
  <?php endforeach; ?>
</ul>