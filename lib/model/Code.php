<?php

/**
 * Subclass for representing a row from the 'repo_code' table.
 *
 * 
 *
 * @package lib.model
 */ 
class Code extends BaseCode
{
    
    public function getTags() {
        $rtn = "";
        $code_tags = $this->getCodeTags();
        foreach($code_tags as $code_tag) {
            $rtn .= $code_tag->getTag()->getTag() . ' ';
        }
        return trim($rtn);
    }


    public function save($con = null) {
        $salt = $this->getTitle().$this->getDescription();
        $this->setCodeHash(sha1($salt.$this->getCode()));
        $arr = myUtils::highlightSnippet($this->getCode());
        $this->setCodeHtmlized($arr['snippet']);
        foreach($this->getCodeLanguages() as $language) {
            $language->delete();
        }
        foreach($arr['languages'] as $language) {
            $code_language = new CodeLanguage();
            $code_language->setCode($this);
            $code_language->setLanguage($language);
            $this->addCodeLanguage($code_language);
        }
        parent::save($con);
    }
    
    public function getHtmlizeCode() {
        $soap = new SoapClient("http://localhost:8080/axis2/services/CodesnippetService?wsdl");
        $rtn = $soap->highlight(array("language"=>$this->getCodeLanguage()->getTag(), "code"=>$this->getCode()));
        return $rtn->return;
    }
    
    public function getComments($criteria = null, $con = null) {
        $c = new Criteria();
        $c->addAscendingOrderByColumn(CommentPeer::CREATED_AT);
        return parent::getComments($c, $con);
    }
    
    //for lucene index
    public function getLanguages() {
        $rtn = "";
        foreach($this->getCodeLanguages() as $code_language) {
            $rtn .= " " . $code_language->getLanguage()->getTag();
        }
        return trim($rtn);
    }

    //for lucene index
    public function getContributor() {
        return ($this->getSfGuardUserId() ? 
            $this->getSfGuardUserId()->getProfile()->getUsername() : $this->getName());
    }
}

sfLucenePropelBehavior::getInitializer()->setupModel('Code');