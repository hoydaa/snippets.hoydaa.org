<?php
class languageSitemapGenerator implements sitemapGenerator
{
    public static function generate() {
    	$urls = array();
    	$langs = SnippetLanguagePeer::getPopularValidLanguages(500);
    	$urls[] = new sitemapURL("language/list", date('F j Y'));
    	foreach($langs as $lang) {
    		$urls[] = new sitemapURL("language/".$lang['language'], date('F j, Y'));
    	}
    	return $urls;
    }
}