<?php

class snippetComponents extends sfComponents
{
  public function executeLanguageConsole()
  {
    $this->logMessage("Textarea: " . $this->textarea, 'debug');
    $this->languages = LanguagePeer::doSelect(new Criteria());
  }

  public function executeMost()
  {
    $most = $this->getRequestParameter('most');

    $this->logMessage('Umut: ' . $most, 'debug');

    if (!$most || $most == 'new')
    {
      $this->snippets = SnippetPeer::getNewCodes($this->getUser()->getPreference('box_snippets_size'));
    }
    else if ($most == 'high')
    {
      $this->snippets = SnippetPeer::getPopularCodes($this->getUser()->getPreference('box_snippets_size'));
    }
    else if ($most == 'disc')
    {
      $this->snippets = SnippetPeer::getMostDiscussedCodes($this->getUser()->getPreference('box_snippets_size'));
    }
    else
    {
      $this->snippets = SnippetPeer::getNewCodes();
    }
  }

  public function executeHighlight()
  {
    $code = $this->code;
    $languages = LanguagePeer::doSelect(new Criteria());
    foreach ($languages as $language)
    {
      $arr = array();
      $exp = sprintf(Code::$REG_EXPRESSION, $language->getTag(), $language->getTag());
      preg_match_all($exp, $code, $arr, PREG_SET_ORDER);
      if (sizeof($arr) > 0)
      {
        for ($i = 0; $i < sizeof($arr); $i++)
        {
          $code = str_replace($arr[$i][0], "<div>".$arr[$i][1]."</div>", $code);
        }
      }
    }

    $arr = array();
    $exp = sprintf(Code::$REG_EXPRESSION, 'other', 'other');
    preg_match_all($exp, $code, $arr, PREG_SET_ORDER);
    if (sizeof($arr) > 0)
    {
      for ($i = 0; $i < sizeof($arr); $i++)
      {
        $code = str_replace($arr[$i][0], "<div>".$arr[$i][1]."</div>", $code);
      }
    }
    $this->code = $code;
  }
}