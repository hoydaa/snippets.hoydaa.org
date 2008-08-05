<?php
/*
 * This file is part of the sfLucenePlugin package
 * (c) 2007 Carl Vondrick <carlv@carlsoft.net>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

require_once(SF_ROOT_DIR . '/plugins/sfLucenePlugin/modules/sfLucene/lib/BasesfLuceneActions.class.php');

/**
 * @package    sfLucenePlugin
 * @subpackage Module
 * @author     Carl Vondrick <carlv@carlsoft.net>
 */
class sfLuceneActions extends BasesfLuceneActions
{
  /**
  * Configures the pager according to the request parameters.
  */
  protected function configurePager($pager)
  {
    $page = (int) ($this->getRequestParameter('page', 1));

    $pager->setMaxPerPage(sfContext::getInstance()->getUser()->getPreference('search_size'));

    if ($page < 1)
    {
      $pager->setPage(1);
    }
    elseif ($page > $pager->getLastPage())
    {
      $pager->setPage($pager->getLastPage());
    }
    else
    {
      $pager->setPage($page);
    }

    return $pager;
  }
}
