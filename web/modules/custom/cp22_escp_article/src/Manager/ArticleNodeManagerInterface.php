<?php

namespace Drupal\cp22_escp_article\Manager;

use Drupal\Core\Cache\CacheBackendInterface;

/**
 *  This interface manage the article node
 */
interface ArticleNodeManagerInterface
{
  /**
   *    With this method you can get Nodes Article Built sort by date
   *    Published nodes with a pager on 10 elements and adapted to languages.
   ***  The attributes of sort is a date sort by changed node (desc or asc)
   * @param string|null $dateSort
   * @return array
   */
  public function getBuiltPublishedNodesArticleWithPagerAndLanguageByDate(?string $dateSort): array;

  /**
   * With this method you can get Nodes Article Built filtred by term and by date sort
   * Get nodes (published or not published) with a pager on 10 elements and adapted to languages.
   *** The attributes to sort are a date sort by changed node (desc or asc) and a term id
   * @param string|null $dateSort
   * @param int|null $term
   * @return array
   */
  public function getBuiltNodesArticleWithPagerAndLanguageByTermByDate(?string $dateSort, ?int $term): array;

  /**
   *  With this method you can get Nodes Article Built filtred by author id
   *  Get nodes article (published or not published) sort by modification date
   *  With a pager of 10 elements adapted to languages.
   ***  The attributes to select the article is the author Id
   * @param int|null $authorId
   * @return array
   */
  public function getNodesArticleSortDescWithPagerAndLanguageByAuthor(?int $authorId): array;

  /**
   *  With this method you can get 3 Nodes Article Built promoted for front page
   *  Get published nodes article sort by modification date desc
   * @return array
   */
  public function get3BuiltPublishedNodesArticlePromotedFrontPageSortDescChanged(): array;

  /**
   * With this method you can get Nodes Article loaded with Ids
   * Get published nodes article sort by date desc of modification date.
   * Adapt to all languages of the website
   * @return array
   */
  public function getOnlyIdsPublishedNodesArticleSortDescChanged(): array;

  /**
   * Used to generate the cloud term on the page of one article.
   * There is a class "active" on the page article the visitor is on
   * Get links therm Themes builded directly rendered on the page
   * @return array
   */
  public function getTheCloudOfTermsThemes(): array;

  /**
   * With this method you get a link built to display on an article page
   * This link display a next article with the same themes published just after in the time
   * @return array|mixed[]|string
   */
  public function getTheNextArticleLinkBuiltDependsOnTheCurrentPageArticleNode();

  /**
   * With this method you get a link built to display on an article page
   * This link display a previous article with the same themes published just after in the time
   * @return array|mixed[]|string
   */
  public function getThePreviousArticleLinkBuiltDependsOnTheCurrentPageArticleNode();


}
