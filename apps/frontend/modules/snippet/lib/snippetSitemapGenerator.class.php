<?php
class snippetSitemapGenerator implements sitemapGenerator
{
    public static function generate() {
    	$urls = array();
    	$snippets = SnippetPeer::doSelect(new Criteria());
    	foreach($snippets as $snippet) {
    		$urls[] = new sitemapURL("snippet/show?id=".$snippet->getId(), date('F j, Y', strtotime($snippet->getUpdatedAt())));
    	}
    	return $urls;
    }
}