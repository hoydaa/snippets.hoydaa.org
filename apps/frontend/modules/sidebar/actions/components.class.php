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

    public function executeTags() {
        $tag_type = $this->getRequestParameter('tag_type');
        
        $this->logMessage('Umut: ' . $tag_type, 'debug');
        
        if(!$tag_type || $tag_type == 'cloud'){
            $this->pop_tags = TagPeer::getPopularTags();
        } else {
            $this->pop_tags = TagPeer::getNewTags();
        }
    }
    
}
