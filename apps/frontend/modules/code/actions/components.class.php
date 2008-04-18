<?php

/**
 * sidebar actions.
 *
 * @package    www.code-repository.com
 * @subpackage user
 * @author     Your name here
 * @version    SVN: $Id$
 */
class codeComponents extends sfComponents
{

    public function executeLanguageConsole() {
        $this->logMessage("Textarea: " . $this->textarea, 'debug');
        $this->languages = LanguagePeer::doSelect(new Criteria());
    }
    
}