<?php

namespace Drupal\cp22_escp_author\Manager;

use Drupal\Core\Cache\CacheBackendInterface;
use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\Core\Routing\RouteMatchInterface;
use Drupal\cp22_escp_article\Manager\ArticleNodeManager;
use Drupal\cp22_escp_author\Gateway\AuthorNodeGateway;

class AuthorNodeManager implements AuthorNodeManagerInterface
{

  //********* CONSTANTES **************************
  const PAGE_BUNDLE = 'author';
  const ENTITY_TYPE = 'node';

  //********* PROPRIETES **************************
  /**
   * @var ArticleNodeManager
   */
  protected $articleNodeManager;
  /**
   * @var RouteMatchInterface
   */
  protected $routeMatch;
  /**
   * @var AuthorNodeGateway
   */
  protected $authorNodeGateway;
  /**
   * @var EntityTypeManagerInterface
   */
  protected $entityTypeManager;
  /**
   * @var CacheBackendInterface
   */
  protected $cacheBackend;

  //********* CONSTRUCTOR **************************

  /**
   * @param ArticleNodeManager $articleNodeManager
   * @param RouteMatchInterface $routeMatch
   * @param AuthorNodeGateway $authorNodeGateway
   * @param EntityTypeManagerInterface $entityTypeManager
   * @param CacheBackendInterface $cacheBackend
   */
  public function __construct(
    ArticleNodeManager         $articleNodeManager,
    RouteMatchInterface        $routeMatch,
    AuthorNodeGateway          $authorNodeGateway,
    EntityTypeManagerInterface $entityTypeManager,
    CacheBackendInterface $cacheBackend)
  {
    $this->articleNodeManager = $articleNodeManager;
    $this->routeMatch = $routeMatch;
    $this->authorNodeGateway = $authorNodeGateway;
    $this->entityTypeManager = $entityTypeManager;
    $this->cacheBackend = $cacheBackend;
  }

  /**
   *  Get nodes article (published and not published) with a pager on 10 elements and adapted to languages.
   * The parameter for these nodes is the id of the author of the current page
   * @return array
   */
  public function getNodesArticleSortDescWithPagerAndLanguageByAuthor(): array
  {
    // Get the current route
    $author_page_id = $this->routeMatch->getRawParameter('node');
    return $this->articleNodeManager->getNodesArticleSortDescWithPagerAndLanguageByAuthor($author_page_id);
  }


  /**
   *    With this method you can get Nodes Authors Built sort by date asc (published and not published)
   * @return array
   */
  public function getNodesAuthorSortAsc(): array
  {
    $AuthorsListBuilt = [];

    // Cache Ids
    $cid = 'cp22_escp_authors_cache_all_authors';
    $cache = $this->cacheBackend->get($cid);

    if($cache){return $cache->data;}

    // Get the nodes
    $authorNodesId = $this->authorNodeGateway->fetchNodesAuthorSortAsc();

    if (empty($authorNodesId)) {
      return $AuthorsListBuilt;
    }

    // Build the nodes for the view
    $viewBuilder = $this->entityTypeManager->getViewBuilder(self::ENTITY_TYPE);
    $AuthorsListBuilt = $viewBuilder->viewMultiple($authorNodesId, "teaser_author_list_page");

    // Set the Cache
    $this->cacheBackend->set($cid, $AuthorsListBuilt, CacheBackendInterface::CACHE_PERMANENT,['node:author']);


    return $AuthorsListBuilt;

  }


  /**
   * Get a list of authors id filtred and sort on the last article changed
   * @return array
   */
  public function getTheArticlesPublishedForAuthorsId(): array
  {
    $authorsListByLastArticle = [];
    // Cache Ids
    $cid = 'cp22_escp_authors_cache_authors_id_last_changed_article';
    $cache = $this->cacheBackend->get($cid);

    if($cache){return $cache->data;}

    // Get the nodes article id
    $lastArticleIds = $this->articleNodeManager->getOnlyIdsPublishedNodesArticleSortDescChanged();

    if(empty($lastArticleIds)){
      return $authorsListByLastArticle;
    }

    // Create an array of authors id
    foreach ($lastArticleIds as $id){
      $idAuthorOfTheArticle = $id->__get('field_author')->getValue('target_id');

      if (!in_array($idAuthorOfTheArticle,$authorsListByLastArticle)){
        $authorsListByLastArticle[] = $idAuthorOfTheArticle;
      }
    }

    // Set the Cache
    $this->cacheBackend->set($cid, $authorsListByLastArticle, CacheBackendInterface::CACHE_PERMANENT,['node:article']);

    return $authorsListByLastArticle;
  }


  /**
   * Get nodes Authors (published and not published) adapted to languages filtred by node ids
   * @param int|null $nids
   * @return array
   */
  public function getNodesAuthorSortDescChangedByNid(?int $nids): array
  {
    return $this->authorNodeGateway->fetchNodesAuthorWithLanguagesByNid($nids);
  }

}
