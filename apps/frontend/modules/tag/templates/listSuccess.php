<?php use_helper('I18N') ?>

<h1><?php echo __('All Tags') ?></h1>

<ul id="tag_cloud">
  <?php foreach($tags as $tag => $rank): ?>
    <li class="rank_<?php echo $rank ?>"><?php echo link_to($tag, 'tag/show?tag=' . $tag) ?></li>
  <?php endforeach; ?>
</ul>