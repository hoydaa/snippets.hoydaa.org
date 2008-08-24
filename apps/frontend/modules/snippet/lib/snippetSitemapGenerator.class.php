<?php

class snippetSitemapGenerator implements sitemapGenerator
{
  public static function generate()
  {
    $c = new Criteria();
    $c->add(SnippetPeer::DRAFT, false);

    $snippets = SnippetPeer::doSelect($c);

    $urls = array();

    foreach($snippets as $snippet)
    {
      $urls[] = new sitemapURL("snippet/show?id=".$snippet->getId(), date('Y-m-d\TH:i:s\Z', strtotime($snippet->getUpdatedAt())), 'weekly', 1.0);
    }

    return $urls;
  }
}