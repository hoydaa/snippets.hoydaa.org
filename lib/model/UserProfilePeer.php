<?php

/**
 * Subclass for performing query and update operations on the 'repo_user_profile' table.
 *
 * 
 *
 * @package lib.model
 */ 
class UserProfilePeer extends BaseUserProfilePeer
{
    public static function retrieveByConfirmation($key) {
        $c = new Criteria();
        $c->add(UserProfilePeer::CONFIRMATION, $key);
        return UserProfilePeer::doSelectOne($c);
    }
}
