<?php
class siteSitemapGenerator implements sitemapGenerator
{
    public static function generate() {
    	$urls = array();
    	$urls[] = new sitemapURL("", date('F j, Y'));
    	return $urls;
    }
}
