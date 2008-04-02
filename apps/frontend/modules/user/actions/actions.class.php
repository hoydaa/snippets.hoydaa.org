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
        if ($this->getRequest()->getMethod() != sfRequest::POST)
        {
	        return sfView::SUCCESS;
        }
        else
        {
            $p = $this->getUser()->getProfile();
            $p->setFirstName($this->getRequestParameter('first_name'));
            $p->setLastName($this->getRequestParameter('last_name'));
            $p->setEmail($this->getRequestParameter('email'));
            $p->save();
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
        if ($this->getRequest()->getMethod() != sfRequest::POST)
        {
	        return sfView::SUCCESS;
        }
        else
        {
            $old_password = $this->getRequestParameter('old_password');
            $new_password = $this->getRequestParameter('new_password');
            if($this->getUser()->getGuardUser()->checkPasswordByGuard($old_password)) {
                $this->getUser()->getGuardUser()->setPassword($new_password);
                $this->getUser()->getGuardUser()->save();
                $this->getRequest()->setError('form-message', array('Your password is changd.'));
                return sfView::SUCCESS;
            } else {
                $this->getRequest()->setError('form-message', array('Your old password is wrong.'));
                return sfView::SUCCESS;
            }
        }
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
