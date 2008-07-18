<?php

class MarkdownDoCodeBlockInterceptor {
    
    public static function intercept($codeblock) {
        $arr = array();
        preg_match('/\[(\w*)\]\n/', $codeblock, $arr);
        if(sizeof($arr) > 0) {
            $service = new SnippetServiceClient();
            if(strtoupper($arr[1]) == 'JAVA') {
                $rtn = $service->highlight('JAVA', preg_replace('/\[(\w*)\]\n/', '', $codeblock));
                $codeblock = $rtn['snippet'];
            } else if(strtoupper($arr[1]) == 'PHP') {
                $rtn = $service->highlight('PHP', preg_replace('/\[(\w*)\]\n/', '', $codeblock));
                $codeblock = $rtn['snippet'];
            } else {
                $codeblock = "<pre><code>".preg_replace('/\[(\w*)\]\n/', '', $codeblock)."\n</code></pre>";
            }
        }
        return $codeblock;
    }
    
}

?>