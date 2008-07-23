<?php

class myUser extends sfGuardSecurityUser
{
    
    public function getId() {
        return $this->getGuardUser()->getId();
    }
    
    public function setPreference($preference, $value)
    {
		$this->setAttribute("app_preference_$preference", $value);
    }
    
    public function getPreference($preference)
    {
    	if(($item = $this->getAttribute("app_preference_$preference"))) 
    	{
    		return $item;
    	}
    	$item = sfConfig::get("app_preference_$preference");
    	sfLogger::getInstance()->info("Sending default preference for app_preference_$preference=$item");
    	return $item;
    }
    
    public function signIn($user, $remember = false, $con = null)
    {
      parent::signIn($user, $remember, $con);
      $this->loadPreferences();
    }
    
	private function loadPreferences() {
	  $this->setPreference('box_user', null);
	  $this->setPreference('box_snippets', null);
	  $this->setPreference('box_language_cloud', null);
	  $this->setPreference('box_tag_cloud', null);
	  $this->setPreference('search_size', null);
	  $this->setPreference('box_snippets_size', null);
	  $this->setPreference('box_order', null);

	  $c = new Criteria();
	  $c->add(PreferencePeer::USER_ID, $this->getId());
	  $preferences = PreferencePeer::doSelect($c);
	  foreach($preferences as $preference)
	  { 
	    if($preference->getName() != 'box_order')
	    {
	      $this->setPreference($preference->getName(), $preference->getValue());
	    } else {
	      $this->setPreference('box_order', explode(", ", $preference->getValue()));
	    }
	  }
	}    
    
}
