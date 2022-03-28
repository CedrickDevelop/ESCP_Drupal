<?php

namespace Drupal\cp22_escp_article\Manager;

use Drupal\Core\Cache\CacheBackendInterface;
use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\Core\Link;
use Drupal\Core\Routing\RouteMatchInterface;
use Drupal\Core\Url;
use Drupal\cp22_escp_article\Gateway\ArticleNodeGatewayInterface;
use Drupal\cp22_escp_themes\Manager\ThemesTermManager;

class ArticleNodeManager implements ArticleNodeManagerInterface
{

  //********* CONSTANTES **************************
  const NODE_TYPE = 'article';
  const ENTITY_TYPE = 'node';

  //********* PROPRIETES **************************
  /**
   * @var ArticleNodeGatewayInterface
   */
  protected $articleNodeGateway;

  /**
   * @var EntityTypeManagerInterface
   */
  protected $entityTypeManager;

  /**
   * @var RouteMatchInterface
   */
  protected $routeMatch;

  /**
   * @var ThemesTermManager
   */
  protected $themesTermManager;

  /**
   * @var CacheBackendInterface
   */
  protected $cacheBackend;

//********* CONSTRUCTEUR **************************

  /**
   * @param EntityTypeManagerInterface $entityTypeManager
   * @param ArticleNodeGatewayInterface $articleNodeGateway
   * @param RouteMatchInterface $routeMatch
   * @param ThemesTermManager $themesTermManager
   * @param CacheBackendInterface $cacheBackend
   */
  public function __construct(
    EntityTypeManagerInterface $entityTypeManager,
    ArticleNodeGatewayInterface $articleNodeGateway,
    RouteMatchInterface $routeMatch,
    ThemesTermManager $themesTermManager,
    CacheBackendInterface $cacheBackend)
  {
    $this->entityTypeManager = $entityTypeManager;
    $this->articleNodeGateway = $articleNodeGateway;
    $this->routeMatch = $routeMatch;
    $this->themesTermManager = $themesTermManager;
    $this->cacheBackend = $cacheBackend;
  }

//******************* METHODES ************************************************

  /**
   *    With this method you can get Nodes Article Built sort by date
   *    Published nodes with a pager on 10 elements and adapted to languages.
   ***  The attributes of sort is a date sort by changed node (desc or asc)
   * @param string|null $dateSort
   * @return array
   */
  public function getBuiltPublishedNodesArticleWithPagerAndLanguageByDate(?string $dateSort): array
  {
    $builtNodes = [];

    // Get the nodes
    $nodesId = $this->articleNodeGateway->fetchPublishedNodesArticleWithPagerAndLanguageByDate($dateSort);

    if(empty($nodesId)) {return $builtNodes;}

    // Build the nodes for the view
    $viewBuilder = $this->entityTypeManager->getViewBuilder(self::ENTITY_TYPE);
    $builtNodes = $viewBuilder->viewMultiple($nodesId, "teaser_list_page" );

    return $builtNodes;
  }

  //**************************

  /**
   * With this method you can get Nodes Article Built filtred by term and by date sort
   * Get nodes (published or not published) with a pager on 10 elements and adapted to languages.
   *** The attributes to sort are a date sort by changed node (desc or asc) and a term id
   * @param string|null $dateSort
   * @param int|null $term
   * @return array
   */
  public function getBuiltNodesArticleWithPagerAndLanguageByTermByDate(?string $dateSort, ?int $term): array
  {
    $builtNodes = [];
//    // Cache Ids
//    $cid = 'cp22_escp_article_cache_published_Article_pager_byDateByTerm';
//    $cache = $this->cacheBackend->get($cid);
//
//    if($cache){return $cache->data;}

    // Get the nodes
    $nodesId = $this->articleNodeGateway->fetchNodesArticleWithPagerAndLanguageByTermByDate($dateSort, $term);

    if(empty($nodesId)) { return $builtNodes;}

    // Build the nodes for the view
    $viewBuilder = $this->entityTypeManager->getViewBuilder(self::ENTITY_TYPE);
    $builtNodes = $viewBuilder->viewMultiple($nodesId, "teaser_list_page" );

//    // Set the Cache
//    $this->cacheBackend->set($cid, $builtNodes, CacheBackendInterface::CACHE_PERMANENT,['node:article']);

    return $builtNodes;
  }

  //**************************

  /**
   *  With this method you can get Nodes Article Built filtred by author id
   *  Get nodes article (published or not published) sort by modification date
   *  With a pager of 10 elements adapted to languages.
   ***  The attributes to select the article is the author Id
   * @param int|null $authorId
   * @return array
   */
  public function getNodesArticleSortDescWithPagerAndLanguageByAuthor(?int $authorId): array
  {
    $builtNodes = [];
    // Cache Ids
    $cid = 'cp22_escp_article_cache_published_Article_pager_byAuthor';
    $cache = $this->cacheBackend->get($cid);

    if($cache){ return $cache->data;}

    // Get the nodes
    $nodesId = $this->articleNodeGateway->fetchNodesArticleSortDescWithPagerAndLanguageByAuthor($authorId);

    if(empty($nodesId)) { return $builtNodes; }

    // Build the nodes for the view
    $viewBuilder = $this->entityTypeManager->getViewBuilder(self::ENTITY_TYPE);
    $builtNodes = $viewBuilder->viewMultiple($nodesId, "teaser_list_page" );

    // Set the Cache
    $this->cacheBackend->set($cid, $builtNodes, CacheBackendInterface::CACHE_PERMANENT,['node:article']);

    return $builtNodes;
  }

  //**************************

  /**
   *  With this method you can get 3 Nodes Article Built promoted for front page
   *  Get published nodes article sort by modification date desc
   * @return array
   */
  public function get3BuiltPublishedNodesArticlePromotedFrontPageSortDescChanged(): array
  {
    $builtNodes = [];

    // Cache Ids
    $cid = 'cp22_escp_article_cache_published_Article_promotedFront';
    $cache = $this->cacheBackend->get($cid);
    if($cache){return $cache->data;}

    // Get the nodes
    $nodesId = $this->articleNodeGateway->fetch3PublishedNodesArticlePromotedFrontPageSortDescChanged();

    if(empty($nodesId)) {return $builtNodes; }

    // Build the nodes for the view
    $viewBuilder = $this->entityTypeManager->getViewBuilder(self::ENTITY_TYPE);
    $builtNodes = $viewBuilder->viewMultiple($nodesId, "teaser_homepage" );

    // Set the Cache
    $this->cacheBackend->set($cid, $builtNodes, CacheBackendInterface::CACHE_PERMANENT,['node:article']);

    return $builtNodes;
  }

  //**************************

  /**
   * With this method you can get Nodes Article loaded with Ids
   * Get published nodes article sort by date desc of modification date.
   * Adapt to all languages of the website
   * @return array
   */
  public function getOnlyIdsPublishedNodesArticleSortDescChanged(): array
  {
    return $this->articleNodeGateway->fetchPublishedNodesArticleSortDescChanged();
  }

  //**************************

  /**
   * Used to generate the cloud term on the page of one article.
   * There is a class "active" on the page article the visitor is on
   * Get links therm Themes builded directly rendered on the page
   * @return array
   */
  public function getTheCloudOfTermsThemes(): array
  {
    $links = [];

    // Cache Ids
    $cid = 'cp22_escp_article_cache_published_Themes_links';
    $cache = $this->cacheBackend->get($cid);

    if($cache){return $cache->data;}

    // Get the id of the node article the visitor id on
    $currentNodeId = $this->articleNodeGateway->fetchOneNodeArticleAndLanguagesByNodeId($this->getTheCurrentPageNodeId());

    // get the theme id of the current node article
    $fieldThemeIdCurrentNode = "";
    foreach ($currentNodeId as $node){
      $fieldThemeIdCurrentNode = $node->__get('field_theme')->getValue('target_id');
    }

    // Get all the taxonomy terms
    $allTermsLoaded = $this->themesTermManager->getPublishedTermsListByWeight();
    if(empty($allTermsLoaded)){ return $links; }

    // We build an array of links to render on the view
    foreach ($allTermsLoaded as $term) {

      // If the visitor is on a term id it will get the "active" class
      if($fieldThemeIdCurrentNode[0]['target_id'] === $term->id()){
        $attributes = ['attributes' => ['class' => ['active']]];
        $url_object_with_attributes = Url::fromRoute('entity.taxonomy_term.canonical', array('taxonomy_term'=>$term->id()), $attributes);
        $link = Link::fromTextAndUrl($term->label(), $url_object_with_attributes);
        $link = $link->toRenderable();
        $links[] = $link;
      }

      // build all the other links
      else {
        $url_object = Url::fromRoute('entity.taxonomy_term.canonical', array('taxonomy_term'=>$term->id()));
        $link = Link::fromTextAndUrl($term->label(), $url_object);
        $link = $link->toRenderable();
        $links[] = $link;
      }
    }
    // Set the Cache
    $this->cacheBackend->set($cid, $links, CacheBackendInterface::CACHE_PERMANENT,['term:themes']);

    return $links;

  }

  //**************************

  /**
   * With this method you get a link built to display on an article page
   * This link display a next article with the same themes published just after in the time
   * @return array|mixed[]|string
   */
  public function getTheNextArticleLinkBuiltDependsOnTheCurrentPageArticleNode(){
    $allNodesId = $this->getNodesLoadedByTermsThemeOfTheCurrentNodeArticle();

    // If there are less articles than expected to get a next
    if(count($allNodesId) < 2){
      return "";
    }

    // Create an array of nodes ids
    $tableauNodes = [];
    foreach ($allNodesId as $node){
      $tableauNodes[] = $node->id();
    }
    $actualNodeInTheArray = array_search($this->getTheCurrentPageNodeId(), $tableauNodes);

    // If the node is the last of the array there are no article after
    if ($actualNodeInTheArray > (count($allNodesId) - 2) ){
      return "";
    }

    // Return the link builded of the next article
    $url_object = Url::fromRoute('entity.node.canonical', array('node'=>$tableauNodes[$actualNodeInTheArray+1]));
    $link = Link::fromTextAndUrl("Suivant", $url_object);
    return $link->toRenderable();

  }

  /**
   * With this method you get a link built to display on an article page
   * This link display a previous article with the same themes published just after in the time
   * @return array|mixed[]|string
   */
  public function getThePreviousArticleLinkBuiltDependsOnTheCurrentPageArticleNode(){

    $allNodesId = $this->getNodesLoadedByTermsThemeOfTheCurrentNodeArticle();

    // If there are less articles than expected to get a previous
    if(count($allNodesId) < 2){ return ""; }

    // Create an array of nodes ids
    $tableauNodes = [];
    foreach ($allNodesId as $node){
      $tableauNodes[] = $node->id();
    }
    $actualNodeInTheArray = array_search($this->getTheCurrentPageNodeId(), $tableauNodes);

    // If the node is the last of the array there are no article after
    if ($actualNodeInTheArray < 1 ){
      return "";
    }

    // Return the link previous builded
    $url_object = Url::fromRoute('entity.node.canonical', array('node'=>$tableauNodes[$actualNodeInTheArray-1]));
    $link = Link::fromTextAndUrl("Précédent", $url_object);
    return $link->toRenderable();
  }


//**************** PROTECTED METHODS ************************

  /**
   * With this method get the id of the current page
   * @return string|null
   */
  protected function getTheCurrentPageNodeId(): ?string
  {
    return $this->routeMatch->getRawParameter('node');
  }

  /**
   * Get the nodes loaded with the same theme as the current page article
   * @return array
   */
  protected function getNodesLoadedByTermsThemeOfTheCurrentNodeArticle(): array
  {
    $nodesId = [];

    // Load the node id of the current page
    $currentNodeId = $this->articleNodeGateway->fetchOneNodeArticleAndLanguagesByNodeId($this->getTheCurrentPageNodeId());

    // get the theme id of the current node article
    $fieldTheme = "";
    foreach ($currentNodeId as $node){
      $fieldTheme = $node->__get('field_theme')->getValue('target_id');
    }

    // Load all the nodes id filtred by themes
    return $this->articleNodeGateway->fetchNodesArticleAndLanguageSortAscCreatedByTerm($fieldTheme[0]['target_id']);

  }



//  /** Not Usefull for the moment */
//  public function getNodesTest(){
//    $nodesId = $this->articleNodeGateway->fetchNodesTest();
//
//    $viewBuilder = $this->entityTypeManager->getViewBuilder(self::ENTITY_TYPE);
//
//    $build = [];
//
//    foreach ($nodesId as $node){
//      $build[] = $viewBuilder->viewMultiple($nodesId);
//    }
//
//    return $build;
//  }


}
