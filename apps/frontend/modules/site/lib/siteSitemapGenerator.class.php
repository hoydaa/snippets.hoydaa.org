<?php
class siteSitemapGenerator implements sitemapGenerator
{

    public static function generate() {
        $MODULES_DIR = SF_ROOT_DIR . DIRECTORY_SEPARATOR . 'apps' . DIRECTORY_SEPARATOR . SF_APP.DIRECTORY_SEPARATOR . 'modules' . DIRECTORY_SEPARATOR;
    
    	$urls = array();
    	$urls[] = new sitemapURL("", date('Y-m-d\TH:i:s\Z'), 'weekly', 0.8);
    	$urls[] = new sitemapURL(
    	    "content/about", 
    	    date('Y-m-d\TH:i:s\Z', 
    	        filemtime($MODULES_DIR.'site'.DIRECTORY_SEPARATOR.'templates'.DIRECTORY_SEPARATOR.'aboutSuccess.php')
    	    ), 
    	    'monthly', 0.8);
    	$urls[] = new sitemapURL(
    	    "content/about", 
    	    date('Y-m-d\TH:i:s\Z', 
    	        filemtime($MODULES_DIR.'site'.DIRECTORY_SEPARATOR.'templates'.DIRECTORY_SEPARATOR.'contactSuccess.php')
    	    ), 
    	    'monthly', 0.8);
    	return $urls;
    }

}
