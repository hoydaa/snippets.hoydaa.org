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
    
}
