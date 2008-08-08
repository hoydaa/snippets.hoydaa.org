<?php

class siteActions extends sfActions
{
  private static $allowedTemplates = array('contact', 'about');

  public function executeIndex()
  {
    $this->snippets = SnippetPeer::getNewCodes(5);
  }

  public function executeContent() {
    $template = $this->getRequestParameter('template');
    
    if(!in_array($template, siteActions::$allowedTemplates)) {
      $this->setTemplate('error');
      return;
    }
    
    $this->setTemplate($template);    
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