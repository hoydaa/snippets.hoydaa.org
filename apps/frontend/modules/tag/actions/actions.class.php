<?php

/**
 * tag actions.
 *
 * @package    www.code-repository.com
 * @subpackage tag
 * @author     Your name here
 * @version    SVN: $Id$
 */
class tagActions extends sfActions
{
    /**
     * Executes index action
     *
     */
    public function executeIndex()
    {
        $this->forward('tag', 'cloud');
    }

    public function executeCloud() {
        
    }
}
