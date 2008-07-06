<?php

class SnippetLanguage extends BaseSnippetLanguage
{
  public function __toString()
  {
    return $this->getName();
  }
}