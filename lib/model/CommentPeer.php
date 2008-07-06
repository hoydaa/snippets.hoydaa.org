<?php

/**
 * Subclass for performing query and update operations on the 'repo_comment' table.
 *
 * 
 *
 * @package lib.model
 */ 
class CommentPeer extends BaseCommentPeer
{

    public static function countUserComments($user_id) {
        $c = new Criteria();
        $c->add(CommentPeer::SF_GUARD_USER_ID, $user_id);

        return CommentPeer::doCount($c);
    }

}
