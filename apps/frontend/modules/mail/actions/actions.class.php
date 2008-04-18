<?php

/**
 * mail actions.
 *
 * @package    www.code-repository.com
 * @subpackage mail
 * @author     Your name here
 * @version    SVN: $Id$
 */
class mailActions extends sfActions {

    public function executeRegister() {
        $email = $this->getRequest()->getAttribute('email');
        $full_name = $this->getRequest()->getAttribute('full_name');
        $activation_key = $this->getRequest()->getAttribute('activation_key');

        $mail = new sfMail();
        $mail->setCharset('utf-8');
        $mail->setSender('codesnippet@hoydaa.org', 'Hoydaa.org Codesnippet');
        $mail->setFrom('codesnippet@hoydaa.org', 'Hoydaa.org Codesnippet');
        $mail->addReplyTo('codesnippet@hoydaa.org');
        $mail->setSubject('codesnippet.hoydaa.org Account Confirmation');
        $mail->addAddress($email);

        $this->mail = $mail;
        $this->full_name = $full_name;
        $this->activation_key = $activation_key;
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