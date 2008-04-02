<?php

/**
 * home actions.
 *
 * @package    www.code-repository.com
 * @subpackage home
 * @author     Your name here
 * @version    SVN: $Id$
 */
class homeActions extends sfActions
{
    public function executeIndex()
    {
        $this->forward('home', 'main');
    }
    
    public function executeMain() {
        return sfView::SUCCESS;
    }
    
}
