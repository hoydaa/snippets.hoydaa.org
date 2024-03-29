<?php use_helper('I18N', 'My') ?>
<?php special_append_to_page_title('All Tags') ?>

<h1><?php echo __('All Tags') ?></h1>

<ul class="tag_cloud all_tags">
  <?php foreach($tags as $tag): ?>
    <li class="rank_<?php echo $tag['rank'] ?>"><?php echo link_to($tag['tag'], 'tag/show?tag=' . $tag['tag'], array('title' => __(":count snippet(s) with tag ':tag'", array(':count' => $tag['count'], ':tag' => $tag['tag'])))) ?></li>
  <?php endforeach; ?>
</ul>