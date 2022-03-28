<?php

namespace Drupal\cp22_escp_author\Manager;

interface AuthorNodeManagerInterface
{

  /**
   *  Get nodes article (published and not published) with a pager on 10 elements and adapted to languages.
   * The parameter for these nodes is the id of the author of the current page
   * @return array
   */
  public function getNodesArticleSortDescWithPagerAndLanguageByAuthor(): array;

  /**
   *    With this method you can get Nodes Authors Built sort by date asc (published and not published)
   * @return array
   */
  public function getNodesAuthorSortAsc(): array;

  /**
   * Get a list of authors id filtred and sort on the last article changed
   * @return array
   */
  public function getTheArticlesPublishedForAuthorsId(): array;

  /**
   * Get nodes Authors (published and not published) adapted to languages filtred by node ids
   * @param int|null $nids
   * @return array
   */
  public function getNodesAuthorSortDescChangedByNid(?int $nids): array;


}
