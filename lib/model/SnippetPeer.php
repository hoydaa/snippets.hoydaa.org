<?php
 
class SnippetPeer extends BaseSnippetPeer
{
  public static function getNewCodes($max = 10)
  {
    $c = new Criteria();
    $c->addDescendingOrderByColumn(SnippetPeer::CREATED_AT);
    $c->setLimit($max);
    return SnippetPeer::doSelect($c);
  }

  public static function getPopularCodes($max = 10)
  {
    $c = new Criteria();
    $c->addDescendingOrderByColumn(SnippetPeer::AVERAGE_RATING);
    $c->setLimit($max);
    return SnippetPeer::doSelect($c);
  }

  public static function getReleatedCodes($id, $max = 10)
  {
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
      TagPeer::CODE_ID,
      TagPeer::TABLE_NAME,
      TagPeer::TAG_ID,
      TagPeer::TAG_ID,
      TagPeer::TABLE_NAME,
      TagPeer::CODE_ID,
      TagPeer::CODE_ID,
      TagPeer::CODE_ID
    );
    $stmt = $con->prepareStatement($sql);
    $stmt->setLimit($max);
    $rs = $stmt->executeQuery();
    while($rs->next())
    {
      $codes[] = SnippetPeer::retrieveByPK($rs->getInt('code_id'));
    }
    return $codes;
  }

  public static function getMostDiscussedCodes($max = 10)
  {
    $codes = array();
    $con = Propel::getConnection();
    $sql = 	"SELECT %s AS code_id FROM %s LEFT JOIN %s ON %s = %s 
      GROUP BY %s order by COUNT(*) desc, %s desc";
    $sql = sprintf($sql,
      SnippetPeer::ID,
      SnippetPeer::TABLE_NAME,
      CommentPeer::TABLE_NAME,
      SnippetPeer::ID,
      CommentPeer::SNIPPET_ID,
      SnippetPeer::ID,
      CommentPeer::ID
    );
    $stmt = $con->prepareStatement($sql);
    $stmt->setLimit($max);
    $rs = $stmt->executeQuery();
    while ($rs->next())
    {
      $codes[] = SnippetPeer::retrieveByPK($rs->getInt('code_id'));
    }
    return $codes;
  }

  public static function getByTag($tag, $page)
  {
    $c = new Criteria();
    $c->addJoin(self::ID, TagPeer::SNIPPET_ID, Criteria::LEFT_JOIN);
    $c->add($c->getNewCriterion(TagPeer::NAME, $tag));
    $c->setDistinct();

    $pager = new sfPropelPager('Snippet', sfConfig::get('app_pager', 10));
    $pager->setCriteria($c);
    $pager->setPage($page);
    $pager->init();

    return $pager;
  }

  public static function countUserSnippets($user_id)
  {
    $c = new Criteria();
    $c->add(SnippetPeer::SF_GUARD_USER_ID, $user_id);

    return SnippetPeer::doCount($c);
  }
}