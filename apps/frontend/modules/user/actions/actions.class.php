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
		if ($this->getRequest()->getMethod() != sfRequest::POST) {
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

	public function handleErrorRegister() {
		return sfView::SUCCESS;
	}

    public function executeConfirmation() {
        $key = $this->getRequestParameter('key');

        if($key) {
            $user_profile = UserProfilePeer::retrieveByConfirmation($key);

            if($user_profile) {
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

    	$this->setFlash('info', 'Your password is changed.');

    	$this->forward('site', 'message');
    }

    public function handleErrorChangePassword() {
        return sfView::SUCCESS;
    }

}