<?php

require_once(sfConfig::get('sf_plugins_dir').'/sfGuardPlugin/modules/sfGuardAuth/lib/BasesfGuardAuthActions.class.php');

class sfGuardAuthActions extends BasesfGuardAuthActions {

	public function executePassword() {
		if ($this->getRequest()->getMethod() != sfRequest::POST) {
			return sfView::SUCCESS;
		}

		$email = $this->getRequestParameter('email');

		$c = new Criteria();
		$c->add(UserProfilePeer::EMAIL, $email);

		$profile = UserProfilePeer::doSelectOne($c);

		if (!$profile) {
			$this->getRequest()->setError('email', 'There is no user with this email.');
			return sfView::SUCCESS;
		}

		$sfGuardUser = $profile->getSfGuardUser();

		$password = substr(md5(rand(100000, 999999)), 0, 6);

		$sfGuardUser->setPassword($password);

		$this->getRequest()->setAttribute('email', $email);
		$this->getRequest()->setAttribute('username', $sfGuardUser->getUsername());
		$this->getRequest()->setAttribute('password', $password);

		$this->sendEmail('mail', 'forgotPassword');

		$sfGuardUser->save();

		return 'Confirmation';
	}

	public function handleErrorPassword() {
		return sfView::SUCCESS;
	}

}