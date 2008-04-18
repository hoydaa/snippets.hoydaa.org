<?php

/**
 * tag components.
 *
 * @package    www.code-repository.com
 * @subpackage tag
 * @author     Umut Utkan
 * @version    SVN: $Id$
 */
class tagComponents extends sfComponents
{

    public function executeCloud() {
        $tag_type = $this->getRequestParameter('tag_type');
        
        $this->logMessage('Umut: ' . $tag_type, 'debug');
        
        if(!$tag_type || $tag_type == 'cloud'){
            $this->pop_tags = TagPeer::getPopularTags();
        } else {
            $this->pop_tags = TagPeer::getNewTags();
        }
    }
    
}
