<?php

class Comment extends BaseComment
{
  public function save($con = null)
  {
    $highlighted = myUtils::highlight($this->getRawBody());
	$this->setBody($highlighted['body']);

    $summarizer = new Summarizer(200);
    $this->setSummary($summarizer->summarize($this->getBody()));

    parent::save();
  }
}