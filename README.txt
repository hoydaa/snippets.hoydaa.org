Required plugins
  symfony plugin-install http://plugins.symfony-project.com/sfPropelActAsRatableBehaviorPlugin
  symfony plugin-install http://plugins.symfony-project.com/sfGuardPlugin
  symfony plugin-install http://plugins.symfony-project.com/sfFeed2Plugin
  symfony plugin-install http://plugins.symfony-project.com/sfLucenePlugin
  symfony plugin-install http://plugins.symfony-project.com/sfCryptographpPlugin
    sfCryptographpPlugin is not currently available on www.symfony-project.org
    use this url for download: http://www.mog-soft.org/symfony/download
    or install using the following command
    symfony plugin-install ext/sfCryptographpPlugin-1.0.0.tgz
  symfony plugin-install http://plugins.symfony-project.com/sfMarkdownPlugin
    sfMarkdown is not currently available, can be temporarily downloaded from
    http://plugins.symfony-project.org/get/sfMarkdownPlugin/sfMarkdownPlugin-0.1.1.tgz
  symfony plugin-install http://plugins.symfony-project.com/isicsSitemapXMLPlugin
  symfony plugin-install http://plugins.symfony-project.com/sfPropelFriendlyUrlBehaviorPlugin

Required Apache Modules
  mod_rewrite
  
Required Php Extensions
  gd, mysql
  
Required Pear Modules
  pear install SOAP-0.11.0
    0.12.0 is available but there is an issue with namespaces.
  