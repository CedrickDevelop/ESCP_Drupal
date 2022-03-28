<?php

namespace Drupal\cp22_escp_article_list\Manager;

use Drupal\Core\Cache\CacheBackendInterface;
use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\cp22_escp_article\Gateway\ArticleNodeGatewayInterface;
use Drupal\cp22_escp_article_list\Gateway\ArticleListNodeGatewayInterface;

class ArticleListNodeManager
{
  //********* CONSTANTES **************************
  const NODE_TYPE = 'article_list';
  const ENTITY_TYPE = 'node';

  //********* PROPRIETES **************************
  /**
   * @var ArticleNodeGatewayInterface
   */
  protected $articleListNodeGateway;
  /**
   * @var EntityTypeManagerInterface
   */
  protected $entityTypeManager;
  /**
   * @var CacheBackendInterface
   */
  protected $cacheBackend;

  //********* CONSTRUCTEUR **************************

  /**
   *  This construct get EntityTypeManager to get data in the database
   *  And get the article list Gateway to fetch the article list
   * @param EntityTypeManagerInterface $entityTypeManager
   * @param ArticleListNodeGatewayInterface $articleListNodeGateway
   * @param CacheBackendInterface $cacheBackend
   */
  public function __construct(
    EntityTypeManagerInterface      $entityTypeManager,
    ArticleListNodeGatewayInterface $articleListNodeGateway,
    CacheBackendInterface $cacheBackend)
  {
    $this->entityTypeManager = $entityTypeManager;
    $this->articleListNodeGateway = $articleListNodeGateway;
    $this->cacheBackend = $cacheBackend;
  }

  /**
   * Get the last id of node article list page changed
   * @return string
   */
  public function getTheLastChangedArticleListPagePublishedId(): string
  {
    // The node Id of the first article list page
    $nodeId = "20";

    // Cache Ids
    $cid = 'cp22_escp_article_cache_published_ArticleList';
    $cache = $this->cacheBackend->get($cid);

    if($cache){return $cache->data;}

    // Get the node id
    $nodesId = $this->articleListNodeGateway->fetchTheLastChangedArticleListPagePublished();

    if(empty($nodesId)) { return $nodeId; }

    // Find the id of the node
    foreach ($nodesId as $node){
      $nodeId = $node->id();
    }

  // Set the Cache
    $this->cacheBackend->set($cid, $nodeId, CacheBackendInterface::CACHE_PERMANENT,['node_list:article']);

    return $nodeId;

  }

}
