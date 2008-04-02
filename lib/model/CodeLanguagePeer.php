<?php

/**
 * Subclass for performing query and update operations on the 'repo_code_language' table.
 *
 * 
 *
 * @package lib.model
 */ 
class CodeLanguagePeer extends BaseCodeLanguagePeer
{
    public static function retrieveByTag($tag) {
        $c = new Criteria();
        $c->add(CodeLanguagePeer::TAG, $tag);
        return CodeLanguagePeer::doSelectOne($c);
    }
}
