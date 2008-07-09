<?php

class TagPeer extends BaseTagPeer
{

  public static function getTagsByName($tag, $max = 10) 
  {
    $connection = Propel::getConnection();
  
    $query = "SELECT DISTINCT %s as tag from %s WHERE tag like = '" . $tag . "%' ORDER BY tag ASC";
    $query = sprintf($query, TagPeer::NAME, TagPeer::TABLE_NAME);
    
    $statement = $connection->prepeareStatement($query);
    $statement->setLimit($max);
    
    $resultset = $statement->executeQuery();
    
    $tags = array();
    
    while($resultset->next())
    {
      $tags[] = $resultset->getString('tag');
    }
    
    return $tags;
  }

  public static function getPopularTags($max = 10)
  {
    $connection = Propel::getConnection();

    $query = 'SELECT %s as tag, COUNT(*) as count FROM %s GROUP BY tag ORDER BY count DESC';
    $query = sprintf($query, TagPeer::NAME, TagPeer::TABLE_NAME);

    $statement = $connection->prepareStatement($query);
    $statement->setLimit($max);

    $resultset = $statement->executeQuery();

    $tags = array();

    $max_count = 0;

    while($resultset->next())
    {
      if (!$max_count)
      {
        $max_count = $resultset->getInt('count');
      }

      $tags[$resultset->getString('tag')] = floor(($resultset->getInt('count') / $max_count * 9) + 1);
    }

    ksort($tags);

    return $tags;
  }
}