<?php

/**
 * Subclass for representing a row from the 'repo_user_profile' table.
 *
 * 
 *
 * @package lib.model
 */ 
class UserProfile extends BaseUserProfile
{
    
    public function getFullName() {
        return $this->getFirstName() . ' ' . $this->getLastName();
    }
    
    public function save($con = null) {
        if($this->isNew())
            $this->setConfirmation(md5(rand(100000, 999999).$this->getEmail()));
        parent::save($con);
    }
    
}
