<?php

class Comment extends BaseComment
{
  public function save($con = null)
  {
    $highlighted = myUtils::highlight($this->getRawBody());
	$this->setBody($highlighted['body']);
	
    $this->setSummary(myUtils::extractSummary($this->getBody(), 10, 200));

    parent::save();
  }
}