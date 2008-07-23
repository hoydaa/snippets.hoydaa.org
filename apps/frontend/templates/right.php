<?php use_helper('Validation', 'I18N', 'Javascript') ?>
                
<ul id="pvalue">
    <?php
    $order = $sf_user->getPreference('box_order');
    if(!in_array('1', $order))
    {
        include("box1.php");
    }
    foreach($order as $box_no)
    {
        include("box$box_no.php");
    }
    ?>
</ul>

<?php echo sortable_element('pvalue', 
    array(
        'url' => '@set_preference?pname=box_order'
    )
) ?>