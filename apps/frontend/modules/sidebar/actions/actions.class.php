<?php

/**
 * sidebar actions.
 *
 * @package    www.code-repository.com
 * @subpackage sidebar
 * @author     Your name here
 * @version    SVN: $Id$
 */
class sidebarActions extends sfActions
{
    
    public function executeMost() {
        
    }
    
    public function executeSearchTag() {
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
    
    public function executeHighlight() {
        $code = $this->getRequestParameter('code');
        $language = $this->getRequestParameter('language');
        $this->logMessage('Umut: ' . $code . $language, 'debug');
        $soap = new SoapClient("http://localhost:8080/axis2/services/CodesnippetService?wsdl");
        $rtn = $soap->highlight(array("language"=>$language, "code"=>$code));
        $this->logMessage('Umut: ' . $rtn->return, 'debug');
        $this->code = $rtn->return;
    }
    
    public function joinTags($tags) {
        $rtn = "";
        for($i = 0; $i < sizeof($tags) - 1; $i++) {
            $rtn .= $tags[$i] . ' ';
        }
        return trim($rtn);
    }
    
}
