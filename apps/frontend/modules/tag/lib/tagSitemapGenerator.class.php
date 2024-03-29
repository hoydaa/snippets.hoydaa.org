<?php
class tagSitemapGenerator implements sitemapGenerator
{
    public static function generate() {
    	$urls = array();
    	$tags = TagPeer::getPopularTags(500);
    	$urls[] = new sitemapURL("tag/list", date('Y-m-d\TH:i:s\Z'), 'daily', 1.0);
    	foreach($tags as $tag) {
    		$urls[] = new sitemapURL("tag/".$tag['tag'], date('Y-m-d\TH:i:s\Z'), 'daily', 1.0);
    	}
    	return $urls;
    }
}