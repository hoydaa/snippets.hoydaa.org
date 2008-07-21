<?php
class tagSitemapGenerator implements sitemapGenerator
{
    public static function generate() {
    	$urls = array();
    	$tags = TagPeer::getPopularTags(500);
    	$urls[] = new sitemapURL("tag/list", date('F j Y'));
    	foreach($tags as $tag => $rank) {
    		$urls[] = new sitemapURL("tag/".$tag, date('F j, Y'));
    	}
    	return $urls;
    }
}