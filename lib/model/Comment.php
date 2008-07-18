<?php

class Comment extends BaseComment
{
  public function getBody()
  {
    if (parent::getBody())
    {
      return parent::getBody();
    }

    $this->setBody(sfMarkdown::doConvert($this->getRawBody()));
    $this->save();

    return $this->getBody();
  }
}