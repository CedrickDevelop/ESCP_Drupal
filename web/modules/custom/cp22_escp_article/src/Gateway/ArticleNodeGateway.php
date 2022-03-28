<?php

namespace Drupal\cp22_escp_article\Gateway;

use Drupal\adimeo_tools\Service\LanguageService;
use Drupal\Component\Plugin\Exception\InvalidPluginDefinitionException;
use Drupal\Component\Plugin\Exception\PluginNotFoundException;
use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\node\NodeInterface;

/**
 *  This class fetch the node article in the database
 */
class ArticleNodeGateway implements ArticleNodeGatewayInterface
{
  //********* CONSTANTES **************************
  const ENTITY_TYPE_NODE = 'node';
  const ARTICLE_BUNDLE = 'article';

  //********* PROPRIETES **************************
  /**
   * @var LanguageService
   */
  protected $languageService;

  /**
   * @var EntityStorageInterface
   */
  protected $getStorage;

  //********* CONSTRUCTEUR **************************

  /**
   * @param EntityTypeManagerInterface $entityTypeManager
   * @param LanguageService $languageService
   * @throws InvalidPluginDefinitionException
   * @throws PluginNotFoundException
   */
  public function __construct(
    EntityTypeManagerInterface $entityTypeManager,
    LanguageService $languageService)
  {
    $this->getStorage = $entityTypeManager->getStorage(self::ENTITY_TYPE_NODE);
    $this->languageService = $languageService->getCurrentLanguageId();
  }

  //******************* METHODES ****************************************

  /**
   *  This method fetch nodes article (published and not published) with a pager on 10 elements and adapted to languages.
   *** The attributes to sort are a date sort by changed node (desc or asc) and a term id
   * @param string|null $dateSort
   * @param string|null $term
   * @return array
   */
  public function fetchNodesArticleWithPagerAndLanguageByTermByDate(?string $dateSort, ?string $term): array{
    $query = $this->getStorage->getQuery();
    $nodesId = $query->condition('type', self::ARTICLE_BUNDLE)
      ->condition('langcode', $this->languageService)
      ->condition('field_theme', $term)
      ->sort('changed', $dateSort)
      ->pager(10)
      ->execute();
    Return  $this->getStorage->loadMultiple($nodesId);
  }

  /**
   * This method fetch published nodes article with a pager on 10 elements and adapted to languages.
   * The attributes of sort is a date sort by changed node (desc or asc)
   * @param string|null $dateSort
   * @return array
   */
  public function fetchPublishedNodesArticleWithPagerAndLanguageByDate(?string $dateSort): array{
    $query = $this->getStorage->getQuery();
    $nodesId = $query->condition('type', self::ARTICLE_BUNDLE)
          ->condition('status', NodeInterface::PUBLISHED)
          ->condition('langcode', $this->languageService)
          ->sort('changed', $dateSort)
          ->pager(10)
          ->execute();

    Return $this->getStorage->loadMultiple($nodesId);
  }

  /**
   * This method fetch nodes article (published or not published) sort by modification date
   * With a pager of 10 elements adapted to languages.
   ***  The attributes to select the article is the author Id
   * @param string|null $authorId
   * @return array
   */
  public function fetchNodesArticleSortDescWithPagerAndLanguageByAuthor(?string $authorId): array{
    $query = $this->getStorage->getQuery();
    $nodesId = $query->condition('type', self::ARTICLE_BUNDLE)
      ->condition('langcode', $this->languageService)
      ->condition('field_author', $authorId)
      ->sort('changed', 'DESC')
      ->pager(10)
      ->execute();
    Return  $this->getStorage->loadMultiple($nodesId);
  }

  /**
   *  This method fetch nodes article (published and not published) sort by modification of node desc adapted to languages.
   ***  The attributes to sort is by term id
   * @param string|null $term
   * @return array
   */
  public function fetchNodesArticleAndLanguageSortDescCreatedByTermByDate(?string $term): array{
    $query = $this->getStorage->getQuery();
    $nodesId = $query->condition('type', self::ARTICLE_BUNDLE)
      ->condition('langcode', $this->languageService)
      ->condition('field_theme', $term)
      ->sort('created', "desc")
      ->execute();
    Return  $this->getStorage->loadMultiple($nodesId);
  }

  /**
   *  This method fetch nodes article (published or not) sort by created date asc
   ***  The attribute to select the nodes is by term id
   * @param string|null $term
   * @return array
   */
  public function fetchNodesArticleAndLanguageSortAscCreatedByTerm(?string $term): array{
    $query = $this->getStorage->getQuery();
    $nodesId = $query->condition('type', self::ARTICLE_BUNDLE)
      ->condition('langcode', $this->languageService)
      ->condition('field_theme', $term)
      ->sort('created', "asc")
      ->execute();
    Return  $this->getStorage->loadMultiple($nodesId);
  }

  /**
   * This method fetch one node article (published or not published) adapted to languages.
   ***  The attributes to select the article is the node Id
   * @param string|null $nid
   * @return array
   */
  public function fetchOneNodeArticleAndLanguagesByNodeId(?string $nid): array{
    $query = $this->getStorage->getQuery();
    $nodesId = $query->condition('type', self::ARTICLE_BUNDLE)
      ->condition('langcode', $this->languageService)
      ->condition('nid', $nid)
      ->execute();
    Return  $this->getStorage->loadMultiple($nodesId);
  }

  /**
   * This method fetch published nodes article sort by date desc of modification date.
   * Adapt to all languages of the website
   * @return array
   */
  public function fetchPublishedNodesArticleSortDescChanged(): array{
    $query = $this->getStorage->getQuery();
    $nodesId = $query->condition('type', self::ARTICLE_BUNDLE)
      ->condition('status', NodeInterface::PUBLISHED)
      ->condition('langcode', $this->languageService)
      ->sort('changed', "DESC")
      ->execute();

    Return $this->getStorage->loadMultiple($nodesId);
  }

  /**
   *  This method fetch 3 published nodes article sort by modification date desc
   *  They are promoted on front page
   * @return array
   */
  public function fetch3PublishedNodesArticlePromotedFrontPageSortDescChanged(): array{
    $query = $this->getStorage->getQuery();
    $nodesId = $query->condition('type', self::ARTICLE_BUNDLE)
      ->condition('langcode', $this->languageService)
      ->condition('status', NodeInterface::PUBLISHED)
      ->condition('promote', true)
      ->sort('changed', 'DESC')
      ->range(0,3)
      ->execute();
    Return  $this->getStorage->loadMultiple($nodesId);
  }

//  public function fetchNodesTest(): array{
////    $query = $this->getStorage->getQuery();
////    $query->condition('type', self::ARTICLE_BUNDLE);
////    $query->condition("langcode", $this->languageService);
////    $query->range(0,1);
////    $nodesId = $query->execute();
////
////    Return $this->getStorage->loadMultiple($nodesId);
////
////  }

}
