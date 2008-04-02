<?php use_helper('My', 'Date') ?>

<?php echo ' created by ' . 
    link_to($code->getContributor(), 'sfLucene/search?query=contributor:' . $code->getContributor()) . 
	' on ' . format_datetime($code->getCreatedAt()) . 
	' with tags: ' . link_to_tags($code->getTags()) ?>