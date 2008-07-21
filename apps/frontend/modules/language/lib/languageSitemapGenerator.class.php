<?php
class languageSitemapGenerator implements sitemapGenerator
{
    public static function generate() {
    	$urls = array();
    	$langs = SnippetLanguagePeer::getPopularValidLanguages(500);
    	foreach($langs as $lang => $rank) {
    		$urls[] = new sitemapURL("language/".$lang, date('F j, Y'));
    	}
    	return $urls;
    }
}