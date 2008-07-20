<?php

class languageComponents extends sfComponents
{
  public function executeCloud()
  {
    $this->languages = SnippetLanguagePeer::getPopularValidLanguages();
  }
}