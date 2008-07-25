<?php

class snippetActions extends sfActions
{
  public function executeIndex()
  {
    $this->forward('snippet', 'edit');
  }

  public function executeList()
  {
    $job = $this->getRequestParameter('job');

    $c = new Criteria();
    if ($job)
    {
      if ($job == 'rating')
      {
        $c->add(RatingPeer::USER_ID, $this->getUser()->getId());
      }
      else if ($job == 'comment')
      {
        $c->add(CommentPeer::USER_ID, $this->getUser()->getId());
      }
    }

    $pager = new sfPropelPager('Snippet', $this->getUser()->getPreference('search_size'));
    $pager->setCriteria($c);
    $pager->setPage($this->getRequestParameter('page', 1));
    $pager->init();

    $this->codePager = $pager;
  }

  public function executeShow()
  {
    $id = $this->getRequestParameter('id');

    $this->code = SnippetPeer::retrieveByPK($id);
    // $this->related_codes = SnippetPeer::getReleatedCodes($id);
  }

  public function executeCreate()
  {
    $this->setTemplate('edit');
  }

  public function executeEdit()
  {
    $id = $this->getRequestParameter('id');

    $this->forward404Unless($id);

    if(!myUtils::isUserRecord('SnippetPeer', $id, $this->getUser()->getId()))
    {
      $this->setFlash('error', 'You don\'t have enough credentials to edit this snippet.');
      $this->forward('site', 'message');
    }

    $code = SnippetPeer::retrieveByPk($id);

    $this->getRequest()->setParameter('title', $code->getTitle());
    $this->getRequest()->setParameter('raw_body', $code->getRawBody());
    $this->getRequest()->setParameter('tags', $code->getTag());
    $this->getRequest()->setParameter('managed_content', $code->getManagedContent());
  }

  public function executeUpdate()
  {
    $id = $this->getRequestParameter('id');

    if (!$id)
    {
      $snippet = new Snippet();
    }
    else
    {
      $snippet = SnippetPeer::retrieveByPk($id);
      $this->forward404Unless($snippet);

      if($snippet->getUserId() != $this->getUser()->getGuardUser()->getId())
      {
        $this->forward('default', 'secure');
      }

      foreach ($snippet->getTags() as $tag)
      {
        $tag->delete();
      }

      $snippet = SnippetPeer::retrieveByPk($id);
    }

    if ($this->getUser()->isAuthenticated())
    {
      $snippet->setUserId($this->getUser()->getGuardUser()->getId());
    }
    else
    {
      $snippet->setName($this->getRequestParameter('name'));
      $snippet->setEmail($this->getRequestParameter('email'));
    }

    $snippet->setTitle($this->getRequestParameter('title'));
    $snippet->setRawBody($this->getRequestParameter('raw_body'));
    $snippet->setBody(null);

    $tag_names = explode(',', $this->getRequestParameter('tags'));

    foreach ($tag_names as $tag_name)
    {
      if (!($tag_name = strtolower(trim($tag_name))))
      {
        continue;
      }

      $tag = new Tag();
      $tag->setName($tag_name);

      $snippet->addTag($tag);
    }

    if ($this->getUser()->hasGroup('EDITOR'))
    {
      if ($this->getRequestParameter('managed_content'))
      {
        $snippet->setManagedContent(1);
      }
      else
      {
        $snippet->setManagedContent(0);
      }
    }

    $snippet->save();

    return $this->redirect('snippet/show?id=' . $snippet->getId());
  }

  public function validateUpdate()
  {
    $id = $this->getRequestParameter('id');
    $name = $this->getRequestParameter('name');
    $email = $this->getRequestParameter('email');
    $captcha = $this->getRequestParameter('captcha');

    $emailValidator = new sfEmailValidator();
    $emailValidator->initialize($this->getContext());

    $captchaValidator = new sfCryptographpValidator;
    $captchaValidator->initialize($this->getContext());

    if (!$this->getUser()->isAuthenticated())
    {
      if (!$name)
      {
        $this->getRequest()->setError('name', 'Please enter your name.');
      }

      if (!$email)
      {
        $this->getRequest()->setError('email', 'Please enter your email address.');
      }
      else if (!$emailValidator->execute($email, $error))
      {
        $this->getRequest()->setError('email', 'Please enter a valid email address.');
      }
    }

    if (!$id)
    {
      if (!$captcha)
      {
        $this->getRequest()->setError('captcha', 'Please type the code shown.');
      }
      else if (!$id && !$captchaValidator->execute($captcha, $error))
      {
        $this->getRequest()->setError('captcha', 'The code you entered is not correct.');
      }
    }

    if ($this->getRequest()->hasErrors())
    {
      return false;
    }

    return true;
  }

  public function handleErrorUpdate()
  {
    $this->setTemplate('edit');

    return sfView::SUCCESS;
  }

  public function executeDelete()
  {
    $id = $this->getRequestParameter('id');
    $this->forward404Unless($id);

    $snippet = SnippetPeer::retrieveByPk($id);
    $this->forward404Unless($snippet);

    if($snippet->getUserId() != $this->getUser()->getGuardUser()->getId())
    {
      $this->forward('default', 'secure');
    }

    $snippet->delete();

    $this->setFlash('info', 'Snippet is completely removed from the system.');
    $this->forward('site', 'message');
  }

  public function executeMost()
  {
  }

  public function executeHighlight()
  {
    $this->code = $this->getRequestParameter('code');
    // $language = $this->getRequestParameter('language');
    // $this->logMessage('Umut: ' . $code . $language, 'debug');
    // $soap = new SoapClient("http://localhost:8080/axis2/services/CodesnippetService?wsdl");
    // $rtn = $soap->highlight(array("language"=>$language, "code"=>$code));
    // $this->logMessage('Umut: ' . $rtn->return, 'debug');
    // $this->code = $rtn->return;
    // $this->code = "<b>" . $code . "</b>";
  }

  public function executeListMySnippets()
  {
    $user_id = $this->getUser()->getGuardUser()->getId();

    $c = new Criteria();
    $c->add(SnippetPeer::USER_ID, $user_id);

    $this->pager = new sfPropelPager('Snippet', $this->getUser()->getPreference('search_size'));
    $this->pager->setCriteria($c);
    $this->pager->setPage($this->getRequestParameter('page', 1));
    $this->pager->init();
  }
}