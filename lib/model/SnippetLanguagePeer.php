<?php
 
class SnippetLanguagePeer extends BaseSnippetLanguagePeer
{
  public static function retrieveByTag($tag)
  {
    $c = new Criteria();
    $c->add(CodeLanguagePeer::TAG, $tag);
    return CodeLanguagePeer::doSelectOne($c);
  }
}