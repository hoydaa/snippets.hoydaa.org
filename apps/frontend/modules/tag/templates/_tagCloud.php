<?php use_helper('Javascript', 'My') ?>
<div class="sidebox">
    <div class="bottom">
        <div class="content" id="tag_cloud_box">
            <table width="100%" border="0" cellpadding="0" cellspacing="0">
                <tr>
                    <td><?php echo image_tag('tags.gif') ?></td>
                    <td align="right"><?php echo toggle('tags-hide', 'tag_cloud-up', 'tag_cloud-down',
                    		$sf_user->getPreference('box_tag_cloud') == 'none' ? 'down' : 'up',
                            remote_function(array('url' => "@set_preference?pname=box_tag_cloud", 'with' => "&quot;pvalue=&quot; + $('tag_cloud-up').style.display"))); ?></td>
                </tr>
            </table>
            <div id="tags-hide"<?php echo $sf_user->getPreference('box_tag_cloud') == 'none' ? " style=display:none;" : "" ?>>
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