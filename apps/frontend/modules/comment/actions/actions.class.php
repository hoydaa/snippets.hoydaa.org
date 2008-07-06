<?php

class commentActions extends sfActions
{
  public function executeAdd()
  {
    $comment = new Comment();

    $comment->setSnippet(SnippetPeer::retrieveByPk($this->getRequestParameter('id')));

    if ($this->getUser()->isAuthenticated())
    {
      $comment->setSfGuardUserId($this->getUser()->getGuardUser()->getId());
    }
    else
    {
      $comment->setName($this->getRequestParameter('name'));
      $comment->setEmail($this->getRequestParameter('email'));
    }

    $comment->setBody($this->getRequestParameter('body'));

    $comment->save();

    $this->comment = $comment;
  }

  public function validateAdd()
  {
    if ($this->getUser()->isAuthenticated())
    {
      return true;
    }

    $name = $this->getRequestParameter('name');
    $email = $this->getRequestParameter('email');

    $emailValidator = new sfEmailValidator();
    $emailValidator->initialize($this->getContext());

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

    if ($this->getRequest()->hasErrors())
    {
      return false;
    }

    return true;
  }

  public function handleErrorAdd()
  {
    $this->getResponse()->setStatusCode(404);
    return sfView::ERROR;
  }
}