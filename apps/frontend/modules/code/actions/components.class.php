<?php

/**
 * sidebar actions.
 *
 * @package    www.code-repository.com
 * @subpackage user
 * @author     Your name here
 * @version    SVN: $Id$
 */
class codeComponents extends sfComponents
{

    public function executeLanguageConsole() {
        $this->logMessage("Textarea: " . $this->textarea, 'debug');
        $this->languages = LanguagePeer::doSelect(new Criteria());
    }
    
    public function executeMost() {
        $most = $this->getRequestParameter('most');

        $this->logMessage('Umut: ' . $most, 'debug');
        
        if(!$most || $most == 'new') {
            $this->snippets = CodePeer::getNewCodes();
        } else if($most == 'high') {
            $this->snippets = CodePeer::getPopularCodes();
        } else if($most == 'disc') {
            $this->snippets = CodePeer::getMostDiscussedCodes();
        } else {
            $this->snippets = CodePeer::getNewCodes();
        }
    }    
    
}