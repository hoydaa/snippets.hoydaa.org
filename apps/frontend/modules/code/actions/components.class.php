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
    
    public function executeMost() {
        $most = $this->getRequestParameter('most');

        $this->logMessage('Umut: ' . $most, 'debug');
        
        if(!$most || $most == 'new') {
            $this->snippets = CodePeer::getNewCodes();
        } else if($most == 'high') {
            $this->snippets = CodePeer::getPopularCodes();
        } else if($most == 'disc') {
            $this->snippets = CodePeer::getMostDiscussedCodes();
        } else {
            $this->snippets = CodePeer::getNewCodes();
        }
    }
    
    public static function executeHighlight($code) {
        $code = $this->getRequestParameter('snippet');
        $languages = LanguagePeer::doSelect(new Criteria());
        foreach($languages as $language) {
            $arr = array();
            $exp = sprintf(Code::$REG_EXPRESSION, $language->getTag(), $language->getTag());
            preg_match_all($exp, $code, $arr, PREG_SET_ORDER);
            if(sizeof($arr) > 0) {
                for($i = 0; $i < sizeof($arr); $i++) {
                    $code = str_replace($arr[$i][0], "<div>".$arr[$i][1]."</div>", $code);
                }
            }
        }
        
        $arr = array();
        $exp = sprintf(Code::$REG_EXPRESSION, 'other', 'other');
        preg_match_all($exp, $code, $arr, PREG_SET_ORDER);
        if(sizeof($arr) > 0) {
            for($i = 0; $i < sizeof($arr); $i++) {
                $code = str_replace($arr[$i][0], "<div>".$arr[$i][1]."</div>", $code);
            }
        }
        return $code;
    }
    
}