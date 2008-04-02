<?php

/**
 * sidebar actions.
 *
 * @package    www.code-repository.com
 * @subpackage sidebar
 * @author     Your name here
 * @version    SVN: $Id$
 */
class sidebarComponents extends sfComponents
{

    public function executeIndex()
    {
        $this->forward('sidebar', 'default');
    }
  
    public function executeDefault() {
        
    }
    
    public function executeMost() {
        $most = $this->getRequestParameter('most');

        $this->logMessage('Umut: ' . $most, 'debug');
        
        if(!$most || $most == 'new') {
            $this->new_codes = CodePeer::getNewCodes();
        } else if($most == 'high') {
            $this->new_codes = CodePeer::getPopularCodes();
        } else if($most == 'disc') {
            $this->new_codes = CodePeer::getMostDiscussedCodes();
        } else {
            $this->new_codes = CodePeer::getNewCodes();
        }
    }

    public function executeTags() {
        $tag_type = $this->getRequestParameter('tag_type');
        
        $this->logMessage('Umut: ' . $tag_type, 'debug');
        
        if(!$tag_type || $tag_type == 'cloud'){
            $this->pop_tags = TagPeer::getPopularTags();
        } else {
            $this->pop_tags = TagPeer::getNewTags();
        }
    }
    
    public function executeLanguageConsole() {
        $this->logMessage("Textarea: " . $this->textarea, 'debug');
        $this->languages = LanguagePeer::doSelect(new Criteria());
    }
    
    public function executeUser() {
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
