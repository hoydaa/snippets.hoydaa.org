<?php

class Snippet extends BaseSnippet
{
  public static $REG_EXPRESSION = "/<%s\-snippet>(.+)<\/%s\-snippet>/isU";

  public function getTag()
  {
    $tag_names = array();
    $tags = $this->getTags();

    foreach($tags as $tag)
    {
      $tag_names[] = $tag->getName();
    }

    return implode(', ', $tag_names);
  }

    public function save($con = null) {
        $salt = $this->getTitle().$this->getDescription();
        $snippet_languages = Snippet::getSnippetLanguagess($this->getBody());
        foreach($this->getSnippetLanguages() as $language) {
            $language->delete();
        }
        foreach($snippet_languages as $language) {
            $code_language = new SnippetLanguage();
            $code_language->setSnippet($this);
            $code_language->setLanguage($language);
            $this->addSnippetLanguage($code_language);
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
        foreach($this->getSnippetLanguages() as $code_language) {
            $rtn .= " " . $code_language->getLanguage()->getTag();
        }
        return trim($rtn);
    }

    //for lucene index
    public function getContributor() {
        return ($this->getSfGuardUserId() ? 
            $this->getSfGuardUser()->getUsername() : $this->getName());
    }
    
    public static function getSnippetLanguagess($snippet_code) {
        $rtn_language = array();
        $languages = LanguagePeer::doSelect(new Criteria());
        foreach($languages as $language) {
            $arr = array();
            $exp = sprintf(self::$REG_EXPRESSION, $language->getTag(), $language->getTag());
            preg_match_all($exp, $snippet_code, $arr, PREG_SET_ORDER);
//            preg_match_all("/<".$language->getTag()."\-snippet>(.+)<\/".$language->getTag()."\-snippet>/isU", $snippet_code, $arr, PREG_SET_ORDER); 
            if(sizeof($arr) > 0)
                $rtn_language[] = $language;
        }
        return $rtn_language;
    }
}

sfLucenePropelBehavior::getInitializer()->setupModel('Snippet');
sfPropelBehavior::add('Snippet', array('sfPropelActAsRatableBehavior'));