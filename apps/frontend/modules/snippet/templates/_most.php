<?php use_helper('Date', 'I18N', 'My', 'Javascript') ?>
<script language="javascript">
    function update_most() {
        <?php echo remote_function(
            array(
                'update' => 'sidebar-snippets',
                'url' => 'snippet/most',
                'with' => "\"most=\" + $('most').value"
            )
        ) ?>    
    }
</script>
<div class="sidebox">
    <div class="bottom">
        <div class="content" id="most_box">
            <table width="100%" border="0" cellpadding="0" cellspacing="0">
                <tr>
                    <td><?php echo image_tag('snippets.gif') ?></td>
                    <td align="right"><?php echo toggle('snippets-hide', 'snippets-up', 'snippets-down', 
                    		$sf_user->getPreference('box_snippets') == 'none' ? 'down' : 'up',
                    		remote_function(array('url' => "@set_preference?pname=box_snippets", 'with' => "&quot;pvalue=&quot; + $('snippets-up').style.display"))); ?></td>
                </tr>
            </table>
            <div id="snippets-hide"<?php echo $sf_user->getPreference('box_snippets') == 'none' ? " style=display:none;" : "" ?>>
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
                <?php echo __('Show') ?>:
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
                        'onchange' => "update_most();"
                    )
                ) ?>
                <?php echo select_tag(
                    'most_size',
                    options_for_select(
                        array(
                            '5' => '5',
                            '10' => '10',
                            '15' => '15',
                            '20' => '20',
                            '25' => '25'
                        ),
                        $sf_user->getPreference('box_snippets_size')
                    ),
                    array(
                        'onchange' => remote_function(array('url' => "@set_preference?pname=box_snippets_size", 'with' => "&quot;pvalue=&quot; + value", 'success' => 'update_most();'))
                    )                    
                ) ?>
            </div>
		</div>
	</div>
</div>