<?php
class tipFilter extends sfFilter
{
  private static $probability = 0.1;
  private static $places = array('header', 'content', 'sidebar');

  public function execute ($filterChain)
  {
	$probability = sfConfig::get('app_tipFilter_probability');
	srand(myUtils::makeSeed());
	$genProb = rand(0, 100) / 100;
    
    // put random message to request
    if($genProb <= $probability) {
        $tip = $this->getTip();
    	$this->getContext()->getRequest()->setParameter('tip', array($tip['place'] => $tip['text']));
    }
    
    // Execute next filter in the chain
    $filterChain->execute();
  }
  
  private function getTip() {
    return tipHolder::getTip();
  }
  
}
