<?php

namespace Drupal\cp22_escp_home\Manager;

use Drupal;
use Drupal\adimeo_tools\Service\LanguageService;
use Drupal\Core\Cache\CacheBackendInterface;
use Drupal\Core\Entity\EntityTypeManager;
use Drupal\cp22_escp_article\Manager\ArticleNodeManager;
use Drupal\cp22_escp_author\Manager\AuthorNodeManager;
use Drupal\cp22_escp_home\Gateway\HomeGateway;


class HomeManager
{
  //********* CONSTANTES **************************
  const SERVICE_NAME = 'cp22_escp_home.home_manager';
  const BUNDLE_TYPE = "home";

  //********* PROPRIETES **************************
  /**
   * @var EntityTypeManager
   */
  protected $entityTypeManager;

  /**
   * @var LanguageService
   */
  protected $languageService;

  /**
   * @var HomeGateway
   */
  protected $homeGateway;
  /**
   * @var ArticleNodeManager
   */
  protected $articleNodeManager;
  /**
   * @var AuthorNodeManager
   */
  protected $authorNodeManager;
  /**
   * @var CacheBackendInterface
   */
  protected $cacheBackend;

  /**
   * Retourne le service (quand pas d'injection de dépendances possible)
   * @return static;
   */
  public static function me() {
    return Drupal::service(static::SERVICE_NAME);
    //$homeManager = HomeManager::me();
  }

  //********* CONSTRUCTEUR **************************

  /**
   * @param EntityTypeManager $entityTypeManager
   * @param LanguageService $languageService
   * @param HomeGateway $homeGateway
   * @param ArticleNodeManager $articleNodeManager
   * @param AuthorNodeManager $authorNodeManager
   */
  public function __construct(
    EntityTypeManager $entityTypeManager,
    LanguageService $languageService,
    HomeGateway $homeGateway,
    ArticleNodeManager $articleNodeManager,
    AuthorNodeManager $authorNodeManager,
    CacheBackendInterface  $cacheBackend) {
    $this->entityTypeManager = $entityTypeManager;
    $this->languageService = $languageService;
    $this->homeGateway = $homeGateway;
    $this->articleNodeManager = $articleNodeManager;
    $this->authorNodeManager = $authorNodeManager;
    $this->cacheBackend = $cacheBackend;
  }

  //******************* METHODES ****************************************

  /**
   * Get the node id of the front page
   * @return int|null
   */
  public function getFrontPageNodeId() {
    return $this->homeGateway->getFrontPageNodeId();
  }

  /**
   * @return array
   */
  public function getFrontPageNodeView() {
    $homeId = $this->getFrontPageNodeId();

    if(!empty($homeId)){
      $view_builder = $this->entityTypeManager->getViewBuilder('node');
      $homeNode = $this->languageService->load('node',$homeId);
      $home = $view_builder->view($homeNode);
      if(!empty($home)){
        return $home;
      }
    }

    return [];
  }

  /**
   * Method to get the 8 author nodes built who wrote the last published nodes article
   *
   * @return array
   */
  public function get8LastAuthorWithPublishedArticle(): array
  {
    $nodesAuthorIdBuilt = [];

    // Cache Ids
    $cid = 'cp22_escp_home_cache_author_by_last_article';
    $cache = $this->cacheBackend->get($cid);

    if($cache){return $cache->data;}

    // Load The Nodes article by last changed date
    $articleNodeId = $this->articleNodeManager->getOnlyIdsPublishedNodesArticleSortDescChanged();

      if (empty($articleNodeId)) {
        return $nodesAuthorIdBuilt;
      }

    // Get nodes author id by each article nodes
    $authorIdFromArticleNodes = [];
    foreach ($articleNodeId as $node){
      $authorIdFromArticleNodes[] = $node->__get('field_author')->getValue();
    }

    // Compare in the array the authors
    $authorsIdArray = [];
    foreach ($authorIdFromArticleNodes as $authorId){
      if(!in_array($authorId[0]['target_id'],$authorsIdArray)){
        $authorsIdArray[] = $authorId[0]['target_id'];
      }
    }

    //Load for the view the authors
    foreach ($authorsIdArray as $authorId){
      $nodesIdAuthorsLoaded = $this->authorNodeManager->getNodesAuthorSortDescChangedByNid($authorId);
      $viewBuilder = $this->entityTypeManager->getViewBuilder('node');
      $nodesAuthorIdBuilt[] =  $viewBuilder->viewMultiple($nodesIdAuthorsLoaded, "teaser_list_homepage");
    }

    // Set the Cache
    $this->cacheBackend->set($cid, $nodesAuthorIdBuilt, CacheBackendInterface::CACHE_PERMANENT,['node:author']);

    return $nodesAuthorIdBuilt;
  }
}
