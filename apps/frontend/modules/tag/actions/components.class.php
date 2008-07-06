<?php

class tagComponents extends sfComponents
{
  public function executeTagCloud()
  {
    $this->tags = TagPeer::getPopularTags();
  }
}