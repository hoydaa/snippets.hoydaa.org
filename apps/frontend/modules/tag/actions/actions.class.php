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

    $c = new Criteria();
    $c->add(TagPeer::NAME, $tag . '%', Criteria::LIKE);

    $this->tags = TagPeer::doSelect($c);
  }

  public function executeShow()
  {
    $this->pager = SnippetPeer::getByTag($this->getRequestParameter('tag'), $this->getRequestParameter('page', 1));
  }
}