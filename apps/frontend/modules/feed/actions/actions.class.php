<?php

/**
 * feed actions.
 *
 * @package    www.code-repository.com
 * @subpackage feed
 * @author     Your name here
 * @version    SVN: $Id$
 */
class feedActions extends sfActions
{
    public function executeIndex()
    {
        $this->forward('feed', 'newCodes');
    }
    
    public function executeNewCodes() {
        $feed = new sfAtom1Feed();

        $feed->setTitle('Hoydaa Codesnippet - New Snippets');
        $feed->setLink('http://codesnippet.hoydaa.org');
        $feed->setAuthorEmail('codesnippet@hoydaa.org');
        $feed->setAuthorName('Hoydaa Codesnippet');

        $codes = SnippetPeer::getNewCodes();

        foreach ($codes as $code)
        {
            $item = new sfFeedItem();
            $item->setTitle($code->getTitle());
            $item->setLink('snippet/show?id='.$code->getId());
            $item->setAuthorName(($code->getSfGuardUser() ? 
                $code->getSfGuardUser()->getProfile()->getFullName() : $code->getName()));
            $item->setAuthorEmail(($code->getSfGuardUser() ? 
                $code->getSfGuardUser()->getProfile()->getEmail() : $code->getEmail()));
            $item->setPubdate($code->getCreatedAt('U'));
            $item->setUniqueId($code->getId());
            $item->setDescription($code->getSummary());

            $feed->addItem($item);
        }

        $this->feed = $feed;
        $this->setTemplate('feed');
    }
    
    public function executeSearch() {
        $feed = new sfAtom1Feed();

        $feed->setTitle('Hoydaa Codesnippet - New Snippets');
        $feed->setLink('http://codesnippet.hoydaa.org');
        $feed->setAuthorEmail('codesnippet@hoydaa.org');
        $feed->setAuthorName('Hoydaa Codesnippet');    
    
    	$querystring = $this->getRequestParameter('q');
    	$query = new sfLuceneCriteria($this->getLuceneInstance());
    	$query->addDescendingSortBy('createdat');
    	$query->addSane($querystring);
    	$pager = new sfLucenePager($this->getLuceneInstance()->friendlyFind($query));
    	
    	$num = $pager->getNbResults();
    	if($num > 0) {
    		$pager->setMaxPerPage(10);
    		$pager->setPage(1);
    		foreach($pager->getResults() as $result) {
            	$item = new sfFeedItem();
            	$item->setTitle($result->getTitle());
            	$item->setLink('snippet/show?id='.$result->getId());
            	$item->setAuthorName($result->getContributor());
            	$item->setPubDate(strtotime($result->getCreatedAt()));
            	//$item->setAuthorEmail(($code->getSfGuardUser() ? 
                //	$code->getSfGuardUser()->getProfile()->getEmail() : $code->getEmail()));
            	$item->setUniqueId($result->getId());
            	$item->setDescription($result->getSummary());

            	$feed->addItem($item);
    		}
    	}
    
    	$this->feed = $feed;
    	$this->setTemplate('feed');
    }
    
  	protected function getLuceneInstance()
  	{
    	return sfLuceneToolkit::getApplicationInstance();
  	}
}
