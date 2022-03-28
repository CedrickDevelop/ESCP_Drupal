<?php

namespace Drupal\cp22_escp_article\Gateway;


/**
 *  This interface offer you to fetch nodes of Article
 */
interface ArticleNodeGatewayInterface
{
  /**
   *   This method fetch nodes article (published and not published) with a pager on 10 elements and adapted to languages.
   *** The attributes to sort are a date sort by changed node (desc or asc) and a term id
   * @param string|null $dateSort
   * @param int|null $term
   * @return array
   */
  public function fetchNodesArticleWithPagerAndLanguageByTermByDate(?string $dateSort, ?string $term): array;

  /**
   *   This method fetch published nodes article with a pager on 10 elements and adapted to languages.
   ***   The attributes of sort is a date sort by changed node (desc or asc)
   * @param string|null $dateSort
   * @return array
   */
  public function fetchPublishedNodesArticleWithPagerAndLanguageByDate(?string $dateSort): array;

  /**
   *  This method fetch nodes article (published or not published) sort by modification date
   *  With a pager of 10 elements adapted to languages.
   ***  The attributes to select the article is the author Id
   * @param int|null $authorId
   * @return array
   */
  public function fetchNodesArticleSortDescWithPagerAndLanguageByAuthor(?string $authorId): array;

  /**
   *    This method fetch nodes article (published and not published) sort by modification of node desc adapted to languages.
   ***  The attributes to sort is by term id
   * @param int|null $term
   * @return array
   */
  public function fetchNodesArticleAndLanguageSortDescCreatedByTermByDate(?string $term): array;

  /**
   *    This method fetch nodes article (published or not) sort by created date asc
   ***  The attribute to select the nodes is by term id
   * @param int|null $term
   * @return array
   */
  public function fetchNodesArticleAndLanguageSortAscCreatedByTerm(?string $term): array;

  /**
   *  This method fetch one node article (published or not published) adapted to languages.
   ***  The attributes to select the article is the node Id
   * @param int|null $nid
   * @return mixed
   */
  public function fetchOneNodeArticleAndLanguagesByNodeId(?string $nid);

  /**
   *  This method fetch 3 published nodes article sort by modification date desc
   *  They are promoted on front page
   * @return array
   */
  public function fetch3PublishedNodesArticlePromotedFrontPageSortDescChanged(): array;

  /**
   * This method fetch published nodes article sort by date desc of modification date.
   * Adapt to all languages of the website
   * @return array
   */
  public function fetchPublishedNodesArticleSortDescChanged(): array;

//  public function fetchNodesTest();


}
