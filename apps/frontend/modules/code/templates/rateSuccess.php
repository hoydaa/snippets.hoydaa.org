

<?php include_partial('code/rater', array(
	'rate_max' => 10, 
	'rate_avg' => $rate_avg, 
	'rater_width' => 200,
    'rater_url' => 'code/rate?code_id=' . $code_id,
    'rater_update' => 'rater-update',
    'rating_count' => $rating_count
)); ?>