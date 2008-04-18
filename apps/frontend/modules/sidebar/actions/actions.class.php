<?php

/**
 * sidebar actions.
 *
 * @package    www.code-repository.com
 * @subpackage sidebar
 * @author     Your name here
 * @version    SVN: $Id$
 */
class sidebarActions extends sfActions
{
    
    public function executeHighlight() {
        $code = $this->getRequestParameter('code');
        $language = $this->getRequestParameter('language');
        $this->logMessage('Umut: ' . $code . $language, 'debug');
        $soap = new SoapClient("http://localhost:8080/axis2/services/CodesnippetService?wsdl");
        $rtn = $soap->highlight(array("language"=>$language, "code"=>$code));
        $this->logMessage('Umut: ' . $rtn->return, 'debug');
        $this->code = $rtn->return;
    }
    
}
