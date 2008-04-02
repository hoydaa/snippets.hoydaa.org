<?php
 
define('SF_ROOT_DIR',    realpath(dirname(__FILE__).'/..'));
define('SF_APP',         'frontend');
define('SF_ENVIRONMENT', 'dev');
define('SF_DEBUG',       true);
 
require_once(SF_ROOT_DIR.DIRECTORY_SEPARATOR.'apps'.DIRECTORY_SEPARATOR.SF_APP.DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'config.php');
 
// initialize database manager
$databaseManager = new sfDatabaseManager();
$databaseManager->initialize();

//$data = new sfPropelData();
//$data->loadData(sfConfig::get('sf_data_dir').DIRECTORY_SEPARATOR.'fixtures');

//$code = CodePeer::retrieveByPK(1);
//$code->setRating(4, 1);
//$code->save();

//$tag = new Tag();
//$tag->setTag('Hede');
//$tag->setTagNormalized(Tag::normalize('Hede'));
//$tag->save();

//$soap = new SoapClient("http://localhost:8080/axis2/services/CodesnippetService?wsdl");
//print_r($soap);
//$func = $soap->__getFunctions();
//print_r($func);
//$rtn = $soap->highlight(array("language"=>"c", "code"=>"deneme"));
//print_r($rtn);
//echo $rtn->return;

    $languages = CodeLanguagePeer::doSelect(new Criteria());
    foreach($languages as $language) {
        $c = new Criteria();
        //$c->add(CommentPeer::ID, 8);
        $comments = CommentPeer::doSelect($c);
        foreach($comments as $comment) {
            echo '<'.$language->getTag().'\-code>(.|\r|\n)+<\/'.$language->getTag().'\-code>' . "\n";
            $arr = array();
            preg_match_all("/<".$language->getTag()."\-code>(.+)<\/".$language->getTag()."\-code>/isU", $comment->getComment(), $arr, PREG_SET_ORDER);
            print_r($arr);
        }
    }
    
    print_r(myUtils::highlightSnippet('deneme'));

?>