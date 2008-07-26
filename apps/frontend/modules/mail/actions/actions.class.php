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
        $mail->setSender('snippets@hoydaa.org', 'Hoydaa Snippets');
        $mail->setFrom('snippets@hoydaa.org', 'Hoydaa Snippets');
        $mail->addReplyTo('snippets@hoydaa.org');
        $mail->setSubject('Hoydaa Snippets - Account Confirmation');
        $mail->addAddress($email);

        $this->mail = $mail;
        $this->full_name = $full_name;
        $this->activation_key = $activation_key;
    }

	public function executeForgotPassword() {
		$email = $this->getRequest()->getAttribute('email');
		$username = $this->getRequest()->getAttribute('username');
		$password = $this->getRequest()->getAttribute('password');
		$full_name = $this->getRequest()->getAttribute('full_name');

		$mail = new sfMail();
        $mail->setCharset('utf-8');
        $mail->setSender('snippets@hoydaa.org', 'Hoydaa Snippets');
        $mail->setFrom('snippets@hoydaa.org', 'Hoydaa Snippets');
        $mail->addReplyTo('snippets@hoydaa.org');
        $mail->setSubject('Hoydaa Snippets - Forgot Password');
        $mail->addAddress($email);

        $this->mail = $mail;
        $this->username = $username;
        $this->password = $password;       
        $this->full_name = $full_name; 
    }

}