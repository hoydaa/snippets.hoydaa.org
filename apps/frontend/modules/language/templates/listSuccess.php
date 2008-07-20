<?php use_helper('I18N') ?>

<h1><?php echo __('All Languages') ?></h1>

<ul class="tag_cloud all_tags">
  <?php foreach($languages as $language => $rank): ?>
    <li class="rank_<?php echo $rank ?>"><?php echo link_to($language, 'language/show?language=' . $language) ?></li>
  <?php endforeach; ?>
</ul>