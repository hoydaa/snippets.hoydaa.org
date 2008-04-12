<?php

/**
 * user actions.
 *
 * @package    www.code-repository.com
 * @subpackage user
 * @author     Your name here
 * @version    SVN: $Id$
 */
class userActions extends sfActions
{

    public function executeIndex()
    {
        $this->forward('user', 'editProfile');
    }

	public function executeEditProfile() {
		if ($this->getRequest()->getMethod() != sfRequest::POST) {
			$user = $this->getUser()->getProfile();

			$this->getRequest()->setParameter('email', $user->getEmail());
			$this->getRequest()->setParameter('first_name', $user->getFirstName());
			$this->getRequest()->setParameter('last_name', $user->getLastName());
		} else {
			$c = new Criteria();
			$c->add(UserProfilePeer::EMAIL, $this->getRequestParameter('email'));

			$profile = UserProfilePeer::doSelectOne($c);

			if ($profile && $profile->getSfGuardUserId() != $this->getUser()->getGuardUser()->getId()) {
				$this->getRequest()->setError('email', 'This email belongs to some other user.');

				return sfView::SUCCESS;
			}

			$c = new Criteria();
			$c->add(UserProfilePeer::SF_GUARD_USER_ID, $this->getUser()->getGuardUser()->getId());

			$profile = UserProfilePeer::doSelectOne($c);

			$profile->setEmail($this->getRequestParameter('email'));
			$profile->setFirstName($this->getRequestParameter('first_name'));
			$profile->setLastName($this->getRequestParameter('last_name'));

			$profile->save();

			$this->getRequest()->setError('form-message', array('User profile saved.'));
		}
	}

	public function handleErrorEditProfile() {
		return sfView::SUCCESS;
	}

    public function executeRegister() {
        if ($this->getRequest()->getMethod() != sfRequest::POST)
        {
	        return sfView::SUCCESS;
        }
        else
        {
            $u = new SfGuardUser();
            $u->setUsername($this->getRequestParameter('username'));
            $u->setPassword($this->getRequestParameter('password'));
            $u->setIsActive(false);
            $p = new UserProfile();
            $p->setFirstName($this->getRequestParameter('first_name'));
            $p->setLastName($this->getRequestParameter('last_name'));
            $p->setEmail($this->getRequestParameter('email'));
            $u->addUserProfile($p);
            $u->save();
            $this->getRequest()->setError('form-message', array('Registration complete.'));

            $this->getRequest()->setAttribute('user_id', $u->getId());
            
            $raw_email = $this->sendEmail('mail', 'register');  
 
            // log the email
            $this->logMessage($raw_email, 'debug');
            
            $this->user = $u;
            
            return 'MailSent';
            
        }        
    }
    
    public function executeConfirmation() {
        $key = $this->getRequestParameter('key');
        if($key) {
            $user_profile = UserProfilePeer::retrieveByConfirmation($key);
            if($user_profile) {
                $user = sfGuardUserPeer::retrieveByPK($user_profile->getSfGuardUserId());
                $user->setIsActive(true);
                $user->save();
                $this->user = $user;
            }
        }
    }

    public function executeChangePassword() {
		if ($this->getRequest()->getMethod() != sfRequest::POST) {
			return sfView::SUCCESS;
		}

		$old_password = $this->getRequestParameter('old_password');
		$new_password = $this->getRequestParameter('new_password');

		if (!$this->getUser()->getGuardUser()->checkPasswordByGuard($old_password)) {
			$this->getRequest()->setError('old_password', 'Your old password is wrong.');

			return sfView::SUCCESS;
		}

		$this->getUser()->getGuardUser()->setPassword($new_password);
		$this->getUser()->getGuardUser()->save();

    	$this->setFlash('message', 'Your password is changed.');

    	$this->forward('site', 'message');
    }

    public function handleErrorRequestPassword() {
        return sfView::SUCCESS;
    }
    
    public function handleErrorChangePassword() {
        return sfView::SUCCESS;
    }
    
    public function executeRequestPassword() {
        if($this->getRequest()->getMethod() != sfRequest::POST) {
            return sfView::SUCCESS;
        } else {
            $username = $this->getRequestParameter('username');
            $email = $this->getRequestParameter('email');
            $c = new Criteria();
            $c->add(sfGuardUserPeer::USERNAME, $username);
            $c->add(UserProfilePeer::EMAIL, $email);
            $user = SfGuardUserPeer::doSelectOne($c);
            
            if($user) {

                // set new random password
                $password = substr(md5(rand(100000, 999999)), 0, 6);
                $user->setPassword($password);
                $user->save();
                
                $this->getRequest()->setAttribute('password', $password);
                $this->getRequest()->setAttribute('user', $user);
                
                $raw_email = $this->sendEmail('mail', 'requestPassword');  
 
                // log the email
                $this->logMessage($raw_email, 'debug'); 
                
                $this->user = $user;
                return 'MailSent';
            } else {
                $this->getRequest()->setError('form-message', array('There is no user with username: ' . 
                    $username . ' and email: ' . $email));
                return sfView::SUCCESS;
            }
        }
    }
    
    public function handleErrorRegister() {
        return sfView::SUCCESS;
    }
    
}
