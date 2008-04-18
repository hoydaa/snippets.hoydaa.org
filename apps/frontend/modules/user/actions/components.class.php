<?php

/**
 * user components.
 *
 * @package    www.code-repository.com
 * @subpackage user
 * @author     Umut Utkan
 * @version    SVN: $Id$
 */
class userComponents extends sfComponents
{

    public function executeBox() {
        $c = new Criteria();
        $c->add(CodePeer::SF_GUARD_USER_ID, $this->getUser()->getId());
        $code_cnt = CodePeer::doCount($c);

        $c = new Criteria();
        $c->add(CommentPeer::SF_GUARD_USER_ID, $this->getUser()->getId());
        $comment_cnt = CommentPeer::doCount($c);
        
        $c = new Criteria();
        $c->add(RatingPeer::SF_GUARD_USER_ID, $this->getUser()->getId());
        $rating_cnt = RatingPeer::doCount($c);
        
        $this->user_code_count = $code_cnt;
        $this->user_comment_count = $comment_cnt;
        $this->user_rating_count = $rating_cnt;
    }

}