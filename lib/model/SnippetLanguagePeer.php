<?php
 
class SnippetLanguagePeer extends BaseSnippetLanguagePeer
{
  public static function getPopularValidLanguages($max = 10)
  {
    $connection = Propel::getConnection();

    $languages = array_keys(sfConfig::get('app_languages'));

    foreach ($languages as $i => $language)
    {
      $languages[$i] = "'$languages[$i]'";
    }

    $query = 'SELECT %s as language, COUNT(*) as count
              FROM %s
              INNER JOIN %s ON %s = %s
              WHERE %s = false AND %s IN (%s)
              GROUP BY language
              ORDER BY count DESC';

    $query = sprintf($query,
      SnippetLanguagePeer::NAME,
      SnippetLanguagePeer::TABLE_NAME,
      SnippetPeer::TABLE_NAME,
      SnippetLanguagePeer::SNIPPET_ID,
      SnippetPeer::ID,
      SnippetPeer::DRAFT,
      SnippetLanguagePeer::NAME,
      implode(', ', $languages)
    );

    $statement = $connection->prepareStatement($query);

    if ($max)
    {
      $statement->setLimit($max);
    }

    $resultset = $statement->executeQuery();

    $languages = array();

    $max_count = 0;

    while($resultset->next())
    {
      if (!$max_count)
      {
        $max_count = $resultset->getInt('count');
      }

      $languages[] = array(
        'language' => $resultset->getString('language'),
        'rank' => floor(($resultset->getInt('count') / $max_count * 9) + 1),
        'count' => ($resultset->getInt('count'))
      );
    }

    ksort($languages);

    return $languages;
  }
}