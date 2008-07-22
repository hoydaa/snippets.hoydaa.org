<?php use_helper('Javascript') ?>

<?php echo label_for('search_size', __('Display') . ' ') ?>
<?php echo select_tag(
    'search_size',
    options_for_select(
        array(
            '10' => '10',
            '20' => '20',
            '30' => '30',
            '40' => '40',
            '50' => '50'
        ),
        $sf_user->getPreference('search_size')
    ),
    array(
        'onchange' => remote_function(
            array(
                'url' => "@set_preference?pname=search_size", 
                'with' => "&quot;pvalue=&quot; + value", 
                'success' => 'window.location.reload();'
            )
        )
    )
) ?>