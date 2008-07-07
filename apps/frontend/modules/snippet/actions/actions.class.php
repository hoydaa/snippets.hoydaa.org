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
        $c->add(RatingPeer::SF_GUARD_USER_ID, $this->getUser()->getId());
      }
      else if ($job == 'comment')
      {
        $c->add(CommentPeer::SF_GUARD_USER_ID, $this->getUser()->getId());
      }
    }

    $pager = new sfPropelPager('Snippet', sfConfig::get('app_pager', 10));
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
      $this->setFlash('error', 'You dont have enough credentials to edit this record.');
      $this->forward('site', 'message');
    }

    $code = SnippetPeer::retrieveByPk($id);

    $this->getRequest()->setParameter('title', $code->getTitle());
    $this->getRequest()->setParameter('description', $code->getTitle());
    $this->getRequest()->setParameter('body', $code->getBody());
    $this->getRequest()->setParameter('tags', $code->getTag());
    $this->getRequest()->setParameter('managed_content', $code->getManagedContent());
  }

  public function executeUpdate()
  {
    if (!$this->getRequestParameter('id'))
    {
      $code = new Snippet();
    }
    else
    {
      $code = SnippetPeer::retrieveByPk($this->getRequestParameter('id'));
      $this->forward404Unless($code);
    }

    if ($this->getUser()->isAuthenticated())
    {
      $code->setSfGuardUserId($this->getUser()->getGuardUser()->getId());
    }
    else
    {
      $code->setName($this->getRequestParameter('name'));
      $code->setEmail($this->getRequestParameter('email'));
    }

    $code->setTitle($this->getRequestParameter('title'));
    $code->setDescription($this->getRequestParameter('description'));
    $code->setBody($this->getRequestParameter('body'));

    foreach ($code->getTags() as $tag)
    {
      $tag->delete();
    }

    $tag_names = explode(',', $this->getRequestParameter('tags'));

    foreach ($tag_names as $tag_name)
    {
      $tag = new Tag();
      $tag->setName(trim($tag_name));

      $code->addTag($tag);
    }

    if ($this->getUser()->hasGroup('EDITOR'))
    {
      if ($this->getRequestParameter('managed_content'))
      {
        $code->setManagedContent(1);
      }
      else
      {
        $code->setManagedContent(0);
      }
    }

    $code->save();

    return $this->redirect('snippet/show?id='.$code->getId());
  }

  public function handleErrorUpdate()
  {
    if (!$this->getRequestParameter('id'))
    {
      $this->forward('snippet', 'create');
    }
    else
    {
      $this->forward('snippet', 'edit');
    }
  }

  public function executeDelete()
  {
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
    $c->add(SnippetPeer::SF_GUARD_USER_ID, $user_id);

    $this->pager = new sfPropelPager('Snippet', sfConfig::get('app_pager', 10));
    $this->pager->setCriteria($c);
    $this->pager->setPage($this->getRequestParameter('page', 1));
    $this->pager->init();
  }
}