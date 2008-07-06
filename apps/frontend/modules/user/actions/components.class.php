<?php

class userComponents extends sfComponents
{
  public function executeBox()
  {
    $user_id = $this->getUser()->getId();

    $this->user_code_count = SnippetPeer::countUserSnippets($user_id);
    $this->user_comment_count = CommentPeer::countUserComments($user_id);
  }
}