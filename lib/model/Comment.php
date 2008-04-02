<?php

/**
 * Subclass for representing a row from the 'repo_comment' table.
 *
 * 
 *
 * @package lib.model
 */ 
class Comment extends BaseComment
{
    
    public function setComment($v) {
        parent::setComment($v);
    }
    
    public function save($con = null) {
        $this->setCommentHtmlized(myUtils::highlightSnippet($this->getComment()));
        parent::save($con);
    }
    
}
