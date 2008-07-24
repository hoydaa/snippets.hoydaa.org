<?php

class siteActions extends sfActions
{
  public function executeIndex()
  {
    $this->snippets = SnippetPeer::getNewCodes(5);
  }

  public function executePopup()
  {
    $this->content = $this->getRequestParameter('content');

    $this->forward404Unless($this->partialExists($this->getContext(), $this->content));
  }

  public function executeMessage()
  {
  }

  protected function partialExists($context, $name)
  {
    $directory = $context->getModuleDirectory();

    return is_readable($directory . DIRECTORY_SEPARATOR . 'templates' . DIRECTORY_SEPARATOR . '_' . $name . '.php');
  }
}