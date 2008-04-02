<?php

/**
 * Subclass for representing a row from the 'repo_tag' table.
 *
 * 
 *
 * @package lib.model
 */ 
class Tag extends BaseTag
{
    
  public static function normalize($tag)
  {
    $n_tag = strtolower($tag);
 
    // remove all unwanted chars
    $n_tag = preg_replace('/[^a-zA-Z0-9]/', '', $n_tag);
 
    return trim($n_tag);
  }
    
}
