<?php
class siteSitemapGenerator implements sitemapGenerator
{
    public static function generate() {
    	$urls = array();
    	$urls[] = new sitemapURL("", date('M j, Y'), 'weekly', 0.8);
    	return $urls;
    }
}
