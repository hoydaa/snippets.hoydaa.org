<?php

class languageActions extends sfActions
{
  public function executeShow()
  {
    $this->pager = SnippetPeer::getByLanguage($this->getRequestParameter('language'), $this->getRequestParameter('page', 1));
    $this->language = $this->getRequestParameter('language');
  }

  public function executeList()
  {
    $this->languages = SnippetLanguagePeer::getPopularValidLanguages(0);
  }
}