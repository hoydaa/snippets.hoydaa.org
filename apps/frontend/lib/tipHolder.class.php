<?php

class tipHolder {

  private static $tipHolder = null;

  private $tips = null;

  private function __construct() {
    $this->tips = array();
    $configs = sfConfig::get('app_tipFilter_tips');
    foreach($configs as $key => $config) {
      $this->tips[] = $config;
    }
  }

  private static function getInstance() {
    if(!self::$tipHolder) {
      self::$tipHolder = new tipHolder();
    }
    return self::$tipHolder;
  }
  
  public static function getTip() {
    $holder = tipHolder::getInstance();
    srand(myUtils::makeSeed());
    return $holder->tips[rand(0, sizeof($holder->tips) - 1)];
  }
  
}