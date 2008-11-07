<?php
 
define('SF_ROOT_DIR',    realpath(dirname(__FILE__).'/..'));
define('SF_APP',         'frontend');
define('SF_ENVIRONMENT', 'dev');
define('SF_DEBUG',       true);
 
require_once(SF_ROOT_DIR.DIRECTORY_SEPARATOR.'apps'.DIRECTORY_SEPARATOR.SF_APP.DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'config.php');
 
// initialize database manager
$databaseManager = new sfDatabaseManager();
$databaseManager->initialize();

$snippets = SnippetPeer::doSelect(new Criteria());
foreach($snippets as $snippet)
{
  echo "Saving snippet#" . $snippet->getId() . ":" . $snippet->getTitle(). "\n";
  $snippet->save();
  echo "     Stripped title: " . $snippet->getFriendlyUrl() . "\n";
}