<?php

/**
 * Subclass for performing query and update operations on the 'repo_tag' table.
 *
 * 
 *
 * @package lib.model
 */ 
class TagPeer extends BaseTagPeer
{
    
    public static function retrieveBy($by_what, $value) {
        $c = new Criteria();
        $c->add($by_what, $value);
        return TagPeer::doSelectOne($c);
    }
    
    public static function getPopularTags($max = 10) {
        $tags = array();
        $con = Propel::getConnection();
        $query = 	"select
        				%s as tag, 
        				%s/(select max(%s) from %s) as pop
        			from 
        				%s 
        			order by 
        				%s";
        $query = sprintf($query,
            TagPeer::TAG_NORMALIZED,
            TagPeer::POPULARITY,
            TagPeer::POPULARITY,
            TagPeer::TABLE_NAME,
            TagPeer::TABLE_NAME,
            TagPeer::TAG_NORMALIZED
        );
        $stmt = $con->prepareStatement($query);
        $stmt->setLimit($max);
        $rs = $stmt->executeQuery();
        while ($rs->next())
        {
            $tags[$rs->getString('tag')] = $rs->getFloat('pop');
        }
        return $tags;        
    }
    
    public static function getNewTags($max = 10) {
        $tags = array();
        $con = Propel::getConnection();
        $query = 	"select
        				%s as tag, 
        				%s/(select max(%s) from %s) as pop
        			from 
        				%s 
        			order by 
        				%s desc";
        $query = sprintf($query,
            TagPeer::TAG_NORMALIZED,
            TagPeer::POPULARITY,
            TagPeer::POPULARITY,
            TagPeer::TABLE_NAME,
            TagPeer::TABLE_NAME,
            TagPeer::CREATED_AT
        );
        $stmt = $con->prepareStatement($query);
        $stmt->setLimit($max);
        $rs = $stmt->executeQuery();
        while ($rs->next())
        {
            $tags[$rs->getString('tag')] = $rs->getFloat('pop');
        }
        return $tags;        
    }
    
}
