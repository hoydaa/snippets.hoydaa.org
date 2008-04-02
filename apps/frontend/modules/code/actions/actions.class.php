<?php

/**
 * code actions.
 *
 * @package    www.code-repository.com
 * @subpackage code
 * @author     Your name here
 * @version    SVN: $Id$
 */
class codeActions extends sfActions
{

    public function executeIndex()
    {
        $this->forward('code', 'edit');
    }
    
    public function executeList() {
        $job = $this->getRequestParameter('job');
        
        $c = new Criteria();
        if($job) {
            if($job == 'rating') {
                $c->add(RatingPeer::SF_GUARD_USER_ID, $this->getUser()->getId());
            } else if($job == 'comment') {
                 $c->add(CommentPeer::SF_GUARD_USER_ID, $this->getUser()->getId());
            }
        }
		    
    	$pager = new sfPropelPager('Code', sfConfig::get('app_pager', 10));
    	$pager->setCriteria($c);
    	$pager->setPage($this->getRequestParameter('page', 1));
    	$pager->init();
    	
    	$this->codePager = $pager;
    }
    
    public function executeShow() {
        $id = $this->getRequestParameter('id');
        $this->code = CodePeer::retrieveByPK($id);
        $this->rel_codes = CodePeer::getReleatedCodes($id);
    }
    
    public function executeEdit() {
        if ($this->getRequest()->getMethod() != sfRequest::POST)
        {
            $id = $this->getRequestParameter('id');
            if($id) {
                $this->code = CodePeer::retrieveByPk($id);
            } else {
                $this->code = new Code();
            }
	        return sfView::SUCCESS;
        }
        else
        {
            $code = $this->extractCodeFromRequest();
            $code->save();
            $this->code = $code;

            $this->getRequest()->setError('form-message', array('Code saved.'));
        }        
    }
    
    public function handleErrorEdit() {
        $this->code = $this->extractCodeFromRequest();
        return sfView::SUCCESS;
    }
    
    public function executeDelete() {
        
    }
    
    public function executeRate() {
        $code_id = $this->getRequestParameter('code_id');
        $rate = $this->getRequestParameter('rate');
        $this->logMessage('Hedeler: ' . $code_id . ' ' . $rate, 'debug');
        $code = CodePeer::retrieveByPK($code_id);
        if($rate) {
            $cnt = $code->countRatings();
            $code->setAverageRating(($code->getAverageRating() * $cnt + $rate) / ($cnt + 1));
            $rating = new Rating();
            $rating->setRating($rate);
            $rating->setCodeId($code_id);
            if($this->getUser()->isAuthenticated())
                $rating->setSfGuardUserId($this->getUser()->getGuardUser()->getId());
            $code->addRating($rating);
            $code->save();
        }
        $this->rate_avg = $code->getAverageRating();
        $this->code_id = $code_id;
        $this->rating_count = $code->countRatings();
    }
    
    public function executeComment() {
        $code_id = $this->getRequestParameter('code_id');
        $comment_id = $this->getRequestParameter('comment_id');
        $code = CodePeer::retrieveByPK($code_id);
        $this->logMessage('Kodun basligi: ' . $code_id, 'debug');
        if($comment_id) {
            $comment = CommentPeer::retrieveByPK($comment_id);
        } else {
            $comment = new Comment();
        }
        $comment_text = $this->getRequestParameter('comment');
        $comment->setTitle($this->getRequestParameter('title'));
        $comment->setComment($comment_text);
        if($this->getUser()->isAuthenticated())
            $comment->setSfGuardUserId($this->getUser()->getGuardUser()->getId());
        else {
            $comment->setName($this->getRequestParameter('name'));
            $comment->setEmail($this->getRequestParameter('email'));
        }
        if($comment_id)
            $comment->save();
        else {
            $code->addComment($comment);
            $code->setCommentCount($code->getCommentCount() + 1);
            $code->save();
        }
        $this->code_id = $code_id;
    }
    
    public function executeCommentList() {
        $code_id = $this->getRequestParameter('code_id');
        $this->code = CodePeer::retrieveByPK($code_id);
    }
    
    public function handleErrorComment() {
        $this->code_id = $this->getRequestParameter('code_id');
        return sfView::SUCCESS;
    }
    
    public function extractCodeFromRequest() {
        $id = $this->getRequestParameter('id');
        if($id) {
            $c = new Criteria();
            $c->add(CodeTagPeer::CODE_ID, $id);
            CodeTagPeer::doDelete($c);
            $code = CodePeer::retrieveByPK($id);
        } else {
            $code = new Code();
        }
        $code->setCode($this->getRequestParameter('code'));
        $code->setTitle($this->getRequestParameter('title'));
        $code->setDescription($this->getRequestParameter('description'));
        if($this->getUser()->isAuthenticated())
            $code->setSfGuardUserId($this->getUser()->getGuardUser()->getId());
        else {
            $code->setName($this->getRequestParameter('name'));
            $code->setEmail($this->getRequestParameter('email'));
        }
        $tags = trim($this->getRequestParameter('tags'));
        if($tags) {
            $tags = explode(" ", $tags);
            foreach($tags as $tag) {
                $dtag = TagPeer::retrieveBy(TagPeer::TAG_NORMALIZED, $tag);
                if(!$dtag) {
                    $dtag = new Tag();
                    $dtag->setTag($tag);
                    $dtag->setTagNormalized(Tag::normalize($tag));
                }
                $dtag->setPopularity($dtag->getPopularity() + 1);
                $code_tag = new CodeTag();
                $code_tag->setTag($dtag);
                $code->addCodeTag($code_tag);
            }
        }
        return $code;        
    }
    
}
