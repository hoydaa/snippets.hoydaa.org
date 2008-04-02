<?php
class myUtils {
    public static function highlightSnippet($snippet) {
        return array('snippet' => $snippet, 'languages' => array(
            LanguagePeer::retrieveByPK(2), LanguagePeer::retrieveByPK(3)
        ));
    }
}
?>