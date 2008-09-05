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

  public function executeHighlight()
  {
    $url = $this->getRequestParameter('url');
    $language = $this->getRequestParameter('language');
    $code = $this->getRequestParameter('code');

    $service = new SnippetServiceClient();
    $output = $service->highlight($language, $code);

    $this->code = $output['snippet'];
    $this->getResponse()->setTitle($url);
  }

  protected function partialExists($context, $name)
  {
    $directory = $context->getModuleDirectory();

    return is_readable($directory . DIRECTORY_SEPARATOR . 'templates' . DIRECTORY_SEPARATOR . '_' . $name . '.php');
  }
}