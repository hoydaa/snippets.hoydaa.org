<?php

class tagActions extends sfActions
{
  public function executeIndex()
  {
    $this->forward('tag', 'cloud');
  }

  public function executeCloud()
  {
  }

  public function executeAutocomplete()
  {
    $tag = $this->getRequestParameter('tags');

    $this->tags = TagPeer::getTagsByName($tag);
  }

  public function executeShow()
  {
    $this->pager = SnippetPeer::getByTag($this->getRequestParameter('tag'), $this->getRequestParameter('page', 1), $this->getUser()->getPreference('search_size'));
    $this->tag = $this->getRequestParameter('tag');
  }

  public function executeList()
  {
    $this->tags = TagPeer::getPopularTags(100);
  }
}