<?php

/**
 * Subclass for performing query and update operations on the 'repo_code' table.
 *
 * 
 *
 * @package lib.model
 */ 
class CodePeer extends BaseCodePeer
{
    
    public static function getNewCodes($max = 10) {
        $c = new Criteria();
        $c->addDescendingOrderByColumn(CodePeer::CREATED_AT);
        $c->setLimit($max);
        return CodePeer::doSelect($c);
    }
    
    public static function getPopularCodes($max = 10) {
        $c = new Criteria();
        $c->addDescendingOrderByColumn(CodePeer::AVERAGE_RATING);
        $c->setLimit($max);
        return CodePeer::doSelect($c);
    }
    
    public static function getReleatedCodes($id, $max = 10) {
        $codes = array();
        $con = Propel::getConnection();
        $sql = 	"select
        			distinct %s as code_id,
					count(1) as cnt
				from
					%s
				where
					%s in	(select
								%s
							from
								%s
							where
								%s = " . $id . ")
					and %s <> " . $id . "
				group by
					%s
				order by
					cnt desc";
        $sql = sprintf($sql,
            CodeTagPeer::CODE_ID,
            CodeTagPeer::TABLE_NAME,
            CodeTagPeer::TAG_ID,
            CodeTagPeer::TAG_ID,
            CodeTagPeer::TABLE_NAME,
            CodeTagPeer::CODE_ID,
            CodeTagPeer::CODE_ID,
            CodeTagPeer::CODE_ID
        );
        $stmt = $con->prepareStatement($sql);
        $stmt->setLimit($max);
        $rs = $stmt->executeQuery();
        while($rs->next()) {
            $codes[] = CodePeer::retrieveByPK($rs->getInt('code_id'));
        }
        return $codes;
        
    }
    
    public static function getMostDiscussedCodes($max = 10) {
        $code = array();
        $con = Propel::getConnection();
        $sql = 	"select
        			%s as code_id
        		from
        			%s
        		order by
        			%s desc";
        $sql = sprintf($sql,
            CodePeer::ID,
            CodePeer::TABLE_NAME,
            CodePeer::COMMENT_COUNT);
        $stmt = $con->prepareStatement($sql);
        $stmt->setLimit($max);
        $rs = $stmt->executeQuery();
        while ($rs->next())
        {
            $codes[] = CodePeer::retrieveByPK($rs->getInt('code_id'));
        }
        return $codes;                    
        
    }
    
    public static function getCodesWithTags($tags) {
        $code = array();
        $con = Propel::getConnection();
        
        $where = "";
        foreach($tags as $tag) {
            $where .= " and tags like '%,".$tag.",%'";
        }
        $sql = "select code_id from view_code_with_tags";
        if(strlen($where) > 0) {
            $where = substr($where, 5);
            $sql .= " where " . $where;
        }

        $stmt = $con->prepareStatement($sql);
        $rs = $stmt->executeQuery();
        while ($rs->next())
        {
            $codes[] = CodePeer::retrieveByPK($rs->getInt('code_id'));
        }
        return $codes;             
    }
    
}
