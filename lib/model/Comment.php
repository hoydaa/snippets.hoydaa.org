<?php

class Comment extends BaseComment
{
  public function save($con = null)
  {
    $this->setBody(sfMarkdown::doConvert($this->getRawBody()));
    $this->setSummary(myUtils::extractSummary($this->getBody(), 10, 200));

    parent::save();
  }
}