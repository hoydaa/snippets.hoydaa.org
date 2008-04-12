<?php

/**
 * mail actions.
 *
 * @package    www.code-repository.com
 * @subpackage mail
 * @author     Your name here
 * @version    SVN: $Id$
 */
class mailActions extends sfActions
{
    
    public function executeRegister() {
        $user = sfGuardUserPeer::retrieveByPK($this->getRequest()->getAttribute('user_id'));

        $this->logMessage('User_id: ' . $this->getRequestParameter('user_id'));
        
        // class initialization
        $mail = new sfMail();
        $mail->setCharset('utf-8');
 
        // definition of the required parameters
        $mail->setSender('codesnippet@hoydaa.org', 'Hoydaa.org Codesnippet');
        $mail->setFrom('codesnippet@hoydaa.org', 'Hoydaa.org Codesnippet');
        $mail->addReplyTo('codesnippet@hoydaa.org');
 
        $mail->addAddress($user->getProfile()->getEmail()); 
        
        $mail->setSubject('codesnippet.hoydaa.org Account Confirmation');
        
        $this->mail = $mail;

        $this->user = $user;
        
    }

	public function executeForgotPassword() {
		$email = $this->getRequest()->getAttribute('email');
		$username = $this->getRequest()->getAttribute('username');
		$password = $this->getRequest()->getAttribute('password');

		$mail = new sfMail();
		$mail->setCharset('utf-8');

		$mail->setSender('codesnippet@hoydaa.org', 'Hoydaa.org Codesnippet');
		$mail->setFrom('codesnippet@hoydaa.org', 'Hoydaa.org Codesnippet');
		$mail->addReplyTo('codesnippet@hoydaa.org');

		$mail->addAddress($email); 

        $mail->setSubject('codesnippet.hoydaa.org Reset Password');

        $this->mail = $mail;
        $this->username = $username;
        $this->password = $password;        
    }

}