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

  public function getMC()
  {
    if ($this->getManagedContent())
      return 'true';
    else
      return 'false';
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

  public function save($con = null)
  {
    $this->setBody(sfMarkdown::doConvert($this->getRawBody()));

    parent::save();
  }
}

sfLucenePropelBehavior::getInitializer()->setupModel('Snippet');
sfPropelBehavior::add('Snippet', array('sfPropelActAsRatableBehavior' => array('rating_field' => 'AverageRating')));