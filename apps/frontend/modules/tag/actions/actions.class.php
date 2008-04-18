<?php

/**
 * tag actions.
 *
 * @package    www.code-repository.com
 * @subpackage tag
 * @author     Your name here
 * @version    SVN: $Id$
 */
class tagActions extends sfActions
{
    /**
     * Executes index action
     *
     */
    public function executeIndex()
    {
        $this->forward('tag', 'cloud');
    }

    public function executeCloud() {
        
    }
    
    public function executeSearch() {
        $tags = $this->getRequestParameter('tags');
        $tags = explode(" ", $tags);
        foreach($tags as $hede) {
            $this->logMessage('Umut: ' . $hede, 'debug');
        }
        $tag = $tags[sizeof($tags) - 1];
        $this->logMessage('Umut: ' . $tag, 'debug');
        if($tag != "") {
            $c = new Criteria();
            $c->add(TagPeer::TAG_NORMALIZED, $tag . '%', Criteria::LIKE);
            $this->tags = TagPeer::doSelect($c);
            $this->prefix = $this->joinTags($tags);
            $this->logMessage('Umut: ' . $this->prefix, 'debug');
            $this->logMessage('Umut: ' . sizeof($this->tags), 'debug');
        } else {
            $this->tags = array();
            $this->prefix = "";
        }
    }
    
    public function joinTags($tags) {
        $rtn = "";
        for($i = 0; $i < sizeof($tags) - 1; $i++) {
            $rtn .= $tags[$i] . ' ';
        }
        return trim($rtn);
    }    
    
}
