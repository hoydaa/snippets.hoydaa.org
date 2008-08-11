<?php use_helper('Javascript') ?>

<?php
if ($sf_user->isAuthenticated()) {
    $choice = $sf_request->getParameter('module') . '/' . $sf_request->getParameter('action');
	if($choice == 'sfLucene/search') { 
		echo button_to_remote(
			__('Save as feed'),
		   	array(
		    	'url' => 'user/addFeed?q=' . $sf_params->get('query'),
		        'update' => 'msg-container',
		        'complete' => "window.alert($('msg-container').innerHTML);"
		    )
		);
	} else if($choice == 'tag/show') {
		echo button_to_remote(
			__('Save as feed'),
		   	array(
		    	'url' => 'user/addFeed?q=tag: ' . $sf_params->get('tag'),
		        'update' => 'msg-container',
		        'complete' => "window.alert($('msg-container').innerHTML);"
		    )
		);
	} else if($choice == 'language/show') {
		echo button_to_remote(
			__('Save as feed'),
		   	array(
		    	'url' => 'user/addFeed?q=languages:' . $sf_params->get('language'),
		        'update' => 'msg-container',
		        'complete' => "window.alert($('msg-container').innerHTML);"
		    )
		);
	}
}
?>

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