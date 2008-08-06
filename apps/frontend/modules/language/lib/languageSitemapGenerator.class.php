<?php
class languageSitemapGenerator implements sitemapGenerator
{
    public static function generate() {
    	$urls = array();
    	$langs = SnippetLanguagePeer::getPopularValidLanguages(500);
    	$urls[] = new sitemapURL("language/list", date('Y-m-d\TH:i:s\Z'), 'daily', 1.0);
    	foreach($langs as $lang) {
    		$urls[] = new sitemapURL("language/".$lang['language'], date('Y-m-d\TH:i:s\Z'), 'daily', 1.0);
    	}
    	return $urls;
    }
}