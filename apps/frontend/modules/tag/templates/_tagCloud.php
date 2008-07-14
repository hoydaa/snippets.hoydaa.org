<?php use_helper('Javascript') ?>
<div class="sidebox">
    <div class="bottom">
        <div class="content" id="tag_cloud_box">
            <table width="100%" border="0" cellpadding="0" cellspacing="0">
                <tr>
                    <td><?php echo image_tag('tags.gif') ?></td>
                    <td align="right"><?php echo toggle('tags-hide', 'tag_cloud-up', 'tag_cloud-down') ?></td>
                </tr>
            </table>
            <div id="tags-hide">
                <ul class="tag_cloud few_tags">
                    <?php foreach($tags as $tag => $rank): ?>
                    <li class="rank_<?php echo $rank ?>"><?php echo link_to($tag, 'tag/show?tag=' . $tag) ?></li>
                    <?php endforeach; ?>
                </ul>
                <?php echo link_to(__('View All'), 'tag/list') ?>
            </div>
        </div>
    </div>
</div>