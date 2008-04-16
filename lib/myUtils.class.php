<?php
class myUtils {
    public static function highlightSnippet($snippet) {
        return array('snippet' => $snippet, 'languages' => array(
            LanguagePeer::retrieveByPK(2), LanguagePeer::retrieveByPK(3)
        ));
//        $languages = CodeLanguagePeer::doSelect(new Criteria());
//    foreach($languages as $language) {
//        $c = new Criteria();
//        //$c->add(CommentPeer::ID, 8);
//        $comments = CommentPeer::doSelect($c);
//        foreach($comments as $comment) {
//            echo '<'.$language->getTag().'\-code>(.|\r|\n)+<\/'.$language->getTag().'\-code>' . "\n";
//            $arr = array();
//            preg_match_all("/<".$language->getTag()."\-code>(.+)<\/".$language->getTag()."\-code>/isU", $comment->getComment(), $arr, PREG_SET_ORDER);
//            print_r($arr);
//        }
//    }        
    }
}
?>