<?php 

java_require("/media/sda4/.m2/repository/org/hoydaa/codesnippet/core/codesnippet-core/1.0-SNAPSHOT/codesnippet-core-1.0-SNAPSHOT.jar");
java_require("/media/sda4/eclipse.workspace/www.code-repository.com/batch/deneme.jar");
//$TokenGroup = new java("org.hoydaa.codesnippet.core.TokenGroup", 5);
//echo (java_values($TokenGroup->getGroupTokenKind()));
$SnippetConfigProxy = new java('SnippetConfigProxy');
$SnippetConfig = $SnippetConfigProxy->getSnippetConfig();
print_r($SnippetConfig);

?>