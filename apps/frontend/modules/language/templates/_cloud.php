<?php use_helper('Javascript', 'My') ?>
<div class="sidebox">
    <div class="bottom">
        <div class="content">
            <table width="100%" border="0" cellpadding="0" cellspacing="0">
                <tr>
                    <td><?php echo image_tag('languages.gif') ?></td>
                    <td align="right"><?php echo toggle('languages-hide', 'language_cloud-up', 'language_cloud-down',
                            $sf_user->getPreference('box_language_cloud') == 'none' ? 'down' : 'up',
                            remote_function(array('url' => "@set_preference?pname=box_language_cloud", 'with' => "&quot;pvalue=&quot; + $('language_cloud-up').style.display"))); ?></td>
                </tr>
            </table>
            <div id="languages-hide"<?php echo $sf_user->getPreference('box_language_cloud') == 'none' ? " style=display:none;" : "" ?>>
                <ul class="tag_cloud few_tags">
                    <?php foreach($languages as $language): ?>
                    <li class="rank_<?php echo $language['rank'] ?>"><?php echo link_to($language['language'], 'language/show?language=' . $language['language'], array('title' => __(":count snippet(s) with ':language' code", array(':count' => $language['count'], ':language' => $language['language'])))) ?></li>
                    <?php endforeach; ?>
                </ul>
                <?php echo link_to(__('View All'), 'language/list') ?>
            </div>
        </div>
    </div>
</div>