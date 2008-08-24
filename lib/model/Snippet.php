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
        foreach($this->getSnippetLanguages() as $language) {
            $rtn .= " " . $language->getName();
        }
        return trim($rtn);
    }

    //for lucene index
    public function getContributor() {
        return ($this->getUserId() ? 
            $this->getSfGuardUser()->getUsername() : $this->getName());
    }

  public function save($con = null)
  {
    $highlighted = myUtils::highlight($this->getRawBody());
	$this->setBody($highlighted['body']);
	foreach($this->getSnippetLanguages() as $language) {
      $language->delete();	  
	}
	
    foreach($highlighted['langs'] as $lang => $count)
    {
      $sl = new SnippetLanguage();
      $sl->setName($lang);
      $sl->setSnippet($this);
      $this->addSnippetLanguage($sl);
    }

    $summarizer = new Summarizer(400);
    $this->setSummary($summarizer->summarize($this->getBody()));

    parent::save();
  }

  public function isIndexable()
  {
    return !$this->getDraft();
  }
}

sfLucenePropelBehavior::getInitializer()->setupModel('Snippet');
sfPropelBehavior::add('Snippet', array('sfPropelActAsRatableBehavior' => array('rating_field' => 'AverageRating')));