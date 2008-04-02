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

        $codes = CodePeer::getNewCodes();

        foreach ($codes as $code)
        {
            $item = new sfFeedItem();
            $item->setTitle($code->getTitle());
            $item->setLink('code/show?id='.$code->getId());
            $item->setAuthorName(($code->getSfGuardUser() ? 
                $code->getSfGuardUser()->getProfile()->getFullName() : $code->getName()));
            $item->setAuthorEmail(($code->getSfGuardUser() ? 
                $code->getSfGuardUser()->getProfile()->getEmail() : $code->getEmail()));
            $item->setPubdate($code->getCreatedAt('U'));
            $item->setUniqueId($code->getId());
            $item->setDescription($code->getDescription());

            $feed->addItem($item);
        }

        $this->feed = $feed;
    }
}
