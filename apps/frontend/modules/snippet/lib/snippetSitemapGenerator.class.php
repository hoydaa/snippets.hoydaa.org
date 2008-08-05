<?php
class snippetSitemapGenerator implements sitemapGenerator
{
    public static function generate() {
    	$urls = array();
    	$snippets = SnippetPeer::doSelect(new Criteria());
    	foreach($snippets as $snippet) {
    		$urls[] = new sitemapURL("snippet/show?id=".$snippet->getId(), date('M j, Y', strtotime($snippet->getUpdatedAt())), 'weekly', 1.0);
    	}
    	return $urls;
    }
}