<h1><?php echo __('Comments') ?></h1>

<ol class="search-results">
  <?php foreach($comments as $comment): ?>
  <li>
    <a name="comment<?php echo $comment->getId() ?>"></a>
    <?php include_partial('comment/show', array('comment' => $comment)) ?>
  </li>
  <?php endforeach; ?>
  <li id="new_comment" style="display: none;"></li>
</ol>