<?php

namespace Drupal\cp22_escp_article_list\Gateway;

/**
 *  Fetch node Article List in the database
 */
interface ArticleListNodeGatewayInterface
{

  /**
   *  This method fetch the last node article list published adapted to languages.
   * @return array
   */
  public function fetchTheLastChangedArticleListPagePublished(): array;

}
