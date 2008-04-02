<?php

/**
 * Subclass for representing a row from the 'repo_code_language' table.
 *
 * 
 *
 * @package lib.model
 */ 
class CodeLanguage extends BaseCodeLanguage
{
    
    public function __toString() {
        return $this->getName();
    }
    
}
