<?php

class userActions extends sfActions
{

  private function putUserFeedsInRequest() {
	$c = new Criteria();
    $c->add(UserFeedPeer::USER_ID, $this->getUser()->getId());
    $feeds = UserFeedPeer::doSelect($c);  
    $this->feeds = $feeds;
  }

  public function executeListFeeds() {
	$this->putUserFeedsInRequest();
  }
  
  public function executeDeleteFeed() {
    $id = $this->getRequestParameter('id');
    
  	$c = new Criteria();
  	$c->add(UserFeedPeer::USER_ID, $this->getUser()->getId());
  	$c->add(UserFeedPeer::ID, $id);
  	$feed = UserFeedPeer::doSelectOne($c);
  	if($feed) {
  		$feed->delete();
  	}
  	$this->putUserFeedsInRequest();
  	$this->setFlash('info', "Feed with id '$id' is deleted.");
  	$this->setTemplate('listFeeds');
  }
  
  public function executeAddFeed() {
  	sfLoader::loadHelpers('I18N');
	
	$query = $this->getRequestParameter('q');
	  	
	$user_feed = new UserFeed();
	$user_feed->setUserId($this->getUser()->getId());
	$user_feed->setQuery($query);
	$user_feed->save();
	  	
	$this->msg = __("User feed is saved with query ':query'.", array(':query' => $query));
  	
  	$this->setTemplate('savePreferences');
  }
  
  public function executeViewProfile()
  {
    $username = $this->getRequestParameter('username');

    $this->user = sfGuardUserPeer::retrieveByUsername($username);

    $c = new Criteria();
    $c->add(SnippetPeer::USER_ID, $this->user->getId());

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

      if ($profile && $profile->getUserId() != $this->getUser()->getGuardUser()->getId())
      {
        $this->getRequest()->setError('email', 'This email belongs to some other user.');
        return sfView::SUCCESS;
      }

      $c = new Criteria();
      $c->add(UserProfilePeer::USER_ID, $this->getUser()->getGuardUser()->getId());

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
        $user = sfGuardUserPeer::retrieveByPK($user_profile->getUserId());
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
  
  public function executeSetPreference()
  {
    $pname = $this->getRequestParameter('pname');
    $pvalue = $this->getRequestParameter('pvalue');
    $this->getUser()->setPreference($pname, $pvalue);
    sfLogger::getInstance()->info("Setting preference $pname=$pvalue");
    return sfView::NONE;
  }
  
  public function executeSavePreferences()
  {
    sfLoader::loadHelpers('I18N');
      $criteria = new Criteria();
      $criteria->add(PreferencePeer::USER_ID, $this->getUser()->getId());
      $preferences = PreferencePeer::doSelect($criteria);
      foreach($preferences as $preference)
      {
        $preference->delete();
      }
      $this->msg = __('Preferences saved.');
      if(($preference = $this->getUser()->getPreference('box_user')) != 
          sfConfig::get('app_preference_box_user'))
      {
        $this->msg .= "\napp_preference_box_user : " . 
            ($preference == 'none' ? __('do not display') : __('display'));
        $p = new Preference();
        $p->setUserId($this->getUser()->getId());
        $p->setName('box_user');
        $p->setValue($preference);
        $p->save();
      }
      if(($preference = $this->getUser()->getPreference('box_snippets')) != 
          sfConfig::get('app_preference_box_snippets'))
      {
        $this->msg .= "\napp_preference_box_snippets : " . 
            ($preference == 'none' ? __('do not display') : __('display'));
        $p = new Preference();
        $p->setUserId($this->getUser()->getId());
        $p->setName('box_snippets');
        $p->setValue($preference);
        $p->save();
      }
      if(($preference = $this->getUser()->getPreference('box_language_cloud')) != 
          sfConfig::get('app_preference_box_language_cloud'))
      {
        $this->msg .= "\napp_preference_box_language_cloud : " . 
            ($preference == 'none' ? __('do not display') : __('display'));
        $p = new Preference();
        $p->setUserId($this->getUser()->getId());
        $p->setName('box_language_cloud');
        $p->setValue($preference);
        $p->save();
      }
      if(($preference = $this->getUser()->getPreference('box_tag_cloud')) != 
          sfConfig::get('app_preference_box_tag_cloud'))
      {
        $this->msg .= "\napp_preference_box_tag_cloud : " . 
            ($preference == 'none' ? __('do not display') : __('display'));
        $p = new Preference();
        $p->setUserId($this->getUser()->getId());
        $p->setName('box_tag_cloud');
        $p->setValue($preference);
        $p->save();
      }
      if(($preference = $this->getUser()->getPreference('box_snippets_size')) != 
          sfConfig::get('app_preference_box_snippets_size'))
      {
        $this->msg .= "\napp_preference_box_snippets_size : " . $preference;
        $p = new Preference();
        $p->setUserId($this->getUser()->getId());
        $p->setName('box_snippets_size');
        $p->setValue($preference);
        $p->save();
      }
      if(($preference = $this->getUser()->getPreference('search_size')) != 
          sfConfig::get('app_preference_search_size'))
      {
        $this->msg .= "\napp_preference_search_size : " . $preference;
        $p = new Preference();
        $p->setUserId($this->getUser()->getId());
        $p->setName('box_search_size');
        $p->setValue($preference);
        $p->save();
      }
      if(($preference = $this->getUser()->getPreference('box_order')) != 
          sfConfig::get('app_preference_box_order'))
      {
        $order_str = "";
        foreach($preference as $order_no)
        {
          $order_str .= "$order_no, ";
        }
        $order_str = substr($order_str, 0, strlen($order_str) - 2);
        $p = new Preference();
        $p->setUserId($this->getUser()->getId());
        $p->setName('box_order');
        $p->setValue($order_str);
        $p->save();
        $this->msg .= "\napp_preference_box_order : " . $order_str;
      }
  }
}