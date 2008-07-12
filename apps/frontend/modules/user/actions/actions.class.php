<?php

class userActions extends sfActions
{
  public function executeViewProfile()
  {
    $username = $this->getRequestParameter('username');

    $this->user = sfGuardUserPeer::retrieveByUsername($username);

    $c = new Criteria();
    $c->add(SnippetPeer::SF_GUARD_USER_ID, $this->user->getId());

    $this->snippet_count = SnippetPeer::doCount($c);

    $this->pager = new sfPropelPager('Snippet', sfConfig::get('app_pager', 10));
    $this->pager->setCriteria($c);
    $this->pager->setPage($this->getRequestParameter('page', 1));
    $this->pager->init();
  }

  public function executeViewAccount()
  {
    $profile = $this->getUser()->getProfile();

    $this->getRequest()->setParameter('first_name', $profile->getFirstName());
    $this->getRequest()->setParameter('last_name', $profile->getLastName());

    if ($profile->getGender() == 'M')
    {
      $this->getRequest()->setParameter('gender', $this->getContext()->getI18N()->__('Male'));
    }
    else if ($profile->getGender() == 'F')
    {
      $this->getRequest()->setParameter('gender', $this->getContext()->getI18N()->__('Female'));
    }

    $this->getRequest()->setParameter('birthday', $profile->getBirthday());
  }

  public function executeEditAccount()
  {
    if ($this->getRequest()->getMethod() != sfRequest::POST)
    {
      $profile = $this->getUser()->getProfile();

      $this->getRequest()->setParameter('first_name', $profile->getFirstName());
      $this->getRequest()->setParameter('last_name', $profile->getLastName());
      $this->getRequest()->setParameter('gender', $profile->getGender());
      $this->getRequest()->setParameter('birthday', $profile->getBirthday());

      return sfView::SUCCESS;
    }

    $profile = $this->getUser()->getProfile();

    $profile->setFirstName($this->getRequestParameter('first_name'));
    $profile->setLastName($this->getRequestParameter('last_name'));
    $profile->setGender($this->getRequestParameter('gender') ? $this->getRequestParameter('gender') : null);
    $profile->setBirthday($this->getRequestParameter('birthday') ? $this->getRequestParameter('birthday') : null);

    $profile->save();

    $this->redirect('user/viewAccount');
  }

  public function validateEditAccount()
  {
    $gender = $this->getRequestParameter('gender');

    if ($gender && $gender != 'M' && $gender != 'F')
    {
      $this->getRequest()->setError('gender', 'Not a valid gender.');
    }

    if ($this->getRequest()->hasErrors())
    {
      return false;
    }

    return true;
  }

  public function handleErrorEditAccount()
  {
    return sfView::SUCCESS;
  }

  public function executeEditProfile()
  {
    if ($this->getRequest()->getMethod() != sfRequest::POST)
    {
      $user = $this->getUser()->getProfile();

      $this->getRequest()->setParameter('email', $user->getEmail());
      $this->getRequest()->setParameter('first_name', $user->getFirstName());
      $this->getRequest()->setParameter('last_name', $user->getLastName());
      $this->getRequest()->setParameter('gender', $user->getGender());
      $this->getRequest()->setParameter('birthday', $user->getBirthday());
    }
    else
    {
      $c = new Criteria();
      $c->add(UserProfilePeer::EMAIL, $this->getRequestParameter('email'));

      $profile = UserProfilePeer::doSelectOne($c);

      if ($profile && $profile->getSfGuardUserId() != $this->getUser()->getGuardUser()->getId())
      {
        $this->getRequest()->setError('email', 'This email belongs to some other user.');
        return sfView::SUCCESS;
      }

      $c = new Criteria();
      $c->add(UserProfilePeer::SF_GUARD_USER_ID, $this->getUser()->getGuardUser()->getId());

      $profile = UserProfilePeer::doSelectOne($c);

      $profile->setEmail($this->getRequestParameter('email'));
      $profile->setFirstName($this->getRequestParameter('first_name'));
      $profile->setLastName($this->getRequestParameter('last_name'));
      $profile->setGender($this->getRequestParameter('gender'));
      $profile->setBirthday($this->getRequestParameter('birthday'));

      $profile->save();

      $this->setFlash('info', 'User profile saved.');
    }
  }

  public function handleErrorEditProfile()
  {
    return sfView::SUCCESS;
  }

  public function executeRegister()
  {
    if ($this->getRequest()->getMethod() != sfRequest::POST)
    {
      return sfView::SUCCESS;
    }

    $user = new SfGuardUser();
    $user->setUsername($this->getRequestParameter('username'));
    $user->setPassword($this->getRequestParameter('password'));
    $user->setIsActive(false);

    $profile = new UserProfile();
    $profile->setEmail($this->getRequestParameter('email'));
    $profile->setFirstName($this->getRequestParameter('first_name'));
    $profile->setLastName($this->getRequestParameter('last_name'));
    $profile->setGender($this->getRequestParameter('gender') ? $this->getRequestParameter('gender') : null);
    $profile->setBirthday($this->getRequestParameter('birthday') ? $this->getRequestParameter('birthday') : null);
    $user->addUserProfile($profile);

    $user->save();

    $this->getRequest()->setAttribute('email', $profile->getEmail());
    $this->getRequest()->setAttribute('full_name', $profile->getFullName());
    $this->getRequest()->setAttribute('activation_key', $profile->getConfirmation());

    $raw_email = $this->sendEmail('mail', 'register');  
    $this->logMessage($raw_email, 'debug');

    $this->setFlash('info', 'We sent a confirmation email to your email address.');
    $this->forward('site', 'message');
  }

  public function validateRegister()
  {
    $gender = $this->getRequestParameter('gender');

    if ($gender && $gender != 'M' && $gender != 'F')
    {
      $this->getRequest()->setError('gender', 'Not a valid gender.');
    }

    if ($this->getRequest()->hasErrors())
    {
      return false;
    }

    return true;
  }

  public function handleErrorRegister()
  {
    return sfView::SUCCESS;
  }

  public function executeConfirmation()
  {
    $key = $this->getRequestParameter('key');

    if ($key)
    {
      $user_profile = UserProfilePeer::retrieveByConfirmation($key);

      if ($user_profile)
      {
        $user = sfGuardUserPeer::retrieveByPK($user_profile->getSfGuardUserId());
        $user->setIsActive(true);
        $user->save();

        $this->setFlash('info', 'Your account has been activated.');
        $this->forward('site', 'message');
      }
    }

    $this->setFlash('error', 'Activation link is not valid.');
    $this->forward('site', 'message');
  }

  public function executeChangeEmail()
  {
    if ($this->getRequest()->getMethod() != sfRequest::POST)
    {
      return sfView::SUCCESS;
    }

    $password = $this->getRequestParameter('password');
    $new_email = $this->getRequestParameter('new_email');

    if (!$this->getUser()->getGuardUser()->checkPasswordByGuard($password))
    {
      $this->getRequest()->setError('password', 'Your password is wrong.');
      return sfView::SUCCESS;
    }

    $profile = $this->getUser()->getProfile();
    $profile->setEmail($new_email);
    $profile->save();

    $this->setFlash('info', 'Your e-mail has been changed.');
    $this->forward('site', 'message');
  }

  public function handleErrorChangeEmail()
  {
    return sfView::SUCCESS;
  }

  public function executeChangePassword()
  {
    if ($this->getRequest()->getMethod() != sfRequest::POST)
    {
      return sfView::SUCCESS;
    }

    $old_password = $this->getRequestParameter('old_password');
    $new_password = $this->getRequestParameter('new_password');

    if (!$this->getUser()->getGuardUser()->checkPasswordByGuard($old_password))
    {
      $this->getRequest()->setError('old_password', 'Your old password is wrong.');

      return sfView::SUCCESS;
    }

    $this->getUser()->getGuardUser()->setPassword($new_password);
    $this->getUser()->getGuardUser()->save();

    $this->setFlash('info', 'Your password is changed.');
    $this->forward('site', 'message');
  }

  public function handleErrorChangePassword()
  {
    return sfView::SUCCESS;
  }
}