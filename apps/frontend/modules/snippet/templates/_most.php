<?php use_helper('Date', 'I18N', 'My', 'Javascript') ?>
<div class="sidebox">
    <div class="bottom">
        <div class="content" id="most_box">
            <table width="100%" border="0" cellpadding="0" cellspacing="0">
                <tr>
                    <td><?php echo image_tag('snippets.gif') ?></td>
                    <td align="right"><?php echo toggle('snippets-hide', 'snippets-up', 'snippets-down') ?></td>
                </tr>
            </table>
            <div id="snippets-hide">
                <ol>
                    <?php foreach ($snippets as $snippet): ?>
                    <li>
                        <h3 class="title"><?php echo link_to($snippet->getTitle(), 'snippet/show?id='.$snippet->getId(), 'class=title'); ?></h3>
                        <?php if ($snippet->getMC() == 'true'): ?>
                        <?php echo image_tag('flag_blue.png', array('alt' => __('Managed Content'), 'title' => __('Managed Content'))) ?>
                        <?php endif; ?>
                        <br />
                        <?php include_partial('snippet/postedBy', array('code' => $snippet)) ?>
                    </li>
                    <?php endforeach; ?>
                </ol>
                <?php echo __('Display') ?>:
                <?php echo select_tag(
                    'most',
                    options_for_select(
                        array(
                            'new' => 'New Snippets',
                            'high' => 'Highest Rated Snippets',
                            'disc' => 'Most Discussed Snippets'
                        ),
                        $sf_params->get('most')
                    ),
                    array(
                        'onchange' => remote_function(
                            array(
                                'update' => 'sidebar-snippets',
                                'url' => 'snippet/most',
                                'with' => '"most=" + value',
                            )
                        ),
                    )
                ) ?>
            </div>
		</div>
	</div>
</div>