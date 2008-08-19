<?php use_helper('Javascript', 'My') ?>
<div class="sidebox">
    <div class="bottom">
        <div class="content" id="tag_cloud_box">
            <?php echo toggle('tags-hide', 'tag_cloud-up', 'tag_cloud-down',
                    $sf_user->getPreference('box_tag_cloud') == 'none' ? 'down' : 'up',
                    remote_function(array('url' => "@set_preference?pname=box_tag_cloud", 'with' => "&quot;pvalue=&quot; + $('tag_cloud-up').style.display"))); ?>
            <?php echo image_tag('tags.gif') ?>
            <div id="tags-hide"<?php echo $sf_user->getPreference('box_tag_cloud') == 'none' ? " style=display:none;" : "" ?>>
                <ul class="tag_cloud few_tags">
                    <?php foreach($tags as $tag): ?>
                    <li class="rank_<?php echo $tag['rank'] ?>"><?php echo link_to($tag['tag'], 'tag/show?tag=' . $tag['tag'], array('title' => __(":count snippet(s) with tag ':tag'", array(':count' => $tag['count'], ':tag' => $tag['tag'])))) ?></li>
                    <?php endforeach; ?>
                </ul>
                <?php echo link_to(__('View All'), 'tag/list', array('title' => __('View All Tags'))) ?>
            </div>
        </div>
    </div>
</div>