Required plugins
  symfony plugin-install http://plugins.symfony-project.com/sfPropelActAsRatableBehaviorPlugin
  symfony plugin-install http://plugins.symfony-project.com/sfGuardPlugin
  symfony plugin-install http://plugins.symfony-project.com/sfFeed2Plugin
  symfony plugin-install http://plugins.symfony-project.com/sfLucenePlugin
  symfony plugin-install http://plugins.symfony-project.com/sfCryptographpPlugin
  symfony plugin-install http://plugins.symfony-project.com/sfMarkdownPlugin

Important Points
  1. After installing sfMarkdownPlugin change the body of the _doCodeBlock_callback($matches) as follows
    function _doCodeBlocks_callback($matches) {
        $codeblock = $matches[1];

        $codeblock = $this->outdent($codeblock);
        $codeblock = htmlspecialchars($codeblock, ENT_NOQUOTES);

        # trim leading newlines and trailing newlines
        $codeblock = preg_replace('/\A\n+|\n+\z/', '', $codeblock);
        
        //ADD THIS LINE
        $codeblock = MarkdownDoCodeBlockInterceptor::intercept($codeblock);
        //COMMENT OUT THE FOLLOWING LINE
        //$codeblock = "<pre><code>$codeblock\n</code></pre>";
        return "\n\n".$this->hashBlock($codeblock)."\n\n";
    }