<?php
class languageSitemapGenerator implements sitemapGenerator
{
    public static function generate() {
    	$urls = array();
    	$langs = SnippetLanguagePeer::getPopularValidLanguages(500);
    	foreach($langs as $lang) {
    		$urls[] = new sitemapURL("language/".$lang['language'], date('F j, Y'));
    	}
    	return $urls;
    }
}