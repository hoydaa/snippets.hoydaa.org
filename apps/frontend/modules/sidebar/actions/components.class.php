<?php

/**
 * sidebar actions.
 *
 * @package    www.code-repository.com
 * @subpackage sidebar
 * @author     Your name here
 * @version    SVN: $Id$
 */
class sidebarComponents extends sfComponents
{

    public function executeIndex()
    {
        $this->forward('sidebar', 'most');
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
