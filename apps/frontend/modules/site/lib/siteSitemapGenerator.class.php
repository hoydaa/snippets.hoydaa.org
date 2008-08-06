<?php
class siteSitemapGenerator implements sitemapGenerator
{
    public static function generate() {
    	$urls = array();
    	$urls[] = new sitemapURL("", date('Y-m-d\TH:i:s\Z'), 'weekly', 0.8);
    	return $urls;
    }
}
