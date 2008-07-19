<?php

class Comment extends BaseComment
{
  public function save($con = null)
  {
    $this->setBody(sfMarkdown::doConvert($this->getRawBody()));

    parent::save();
  }
}