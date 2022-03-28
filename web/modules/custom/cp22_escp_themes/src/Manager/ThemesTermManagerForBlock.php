<?php

namespace Drupal\cp22_escp_themes\Manager;

use Drupal\Core\Controller\TitleResolver;
use Drupal\Core\Link;
use Drupal\Core\Routing\RouteMatchInterface;
use Drupal\Core\Url;
use Drupal\cp22_escp_global\Manager\BasicListOfTaxonomyTermsManager;

class ThemesTermManagerForBlock
{
  //********* CONSTANTES **************************
  Const ENTITY_TYPE = 'taxonomy_term';

  //********* PROPRIETES **************************
  /**
   * @var ThemesTermManager
   */
  protected $themesTermManager;
  /**
   * @var TitleResolver
   */
  protected $titleResolver;
  /**
   * @var RouteMatchInterface
   */
  protected $routeMatch;

  //********* CONSTRUCTEUR **************************

  /**
   * @param ThemesTermManager $themesTermManager
   * @param RouteMatchInterface $routeMatch
   */
  public function __construct(
    ThemesTermManager $themesTermManager,
    RouteMatchInterface $routeMatch
  )
  {
    $this->themesTermManager = $themesTermManager;
    $this->routeMatch = $routeMatch;
  }
//******************* METHODES ************************************************

  /**
   * With this method you can get a list of Taxonomy term themes that you can display directly on the page
   * On a taxonomy page, the current themes wil have an "active" class
   * @return array
   */
  public function getLinksForBlockThemesTermAdaptedForNodesAndTaxonomyPages(): array
  {

    $links = [];
    $terms_loaded = $this->themesTermManager->getPublishedTermsListByWeight();

    if(empty($terms_loaded)){
      return $links;
    }

    if ($this->isRouteTaxoOrNode() === "node"){
      $links = $this->createTaxonomyLinksForNodesPage($terms_loaded);
    }

    if ($this->isRouteTaxoOrNode() === "taxonomy"){
      $links = $this->createTaxonomyLinksForTaxonomyPage($terms_loaded);
    }


    return $links;
  }

////************************* PROTECTED METHODS ****************************

  /**
   * With this method you can have the kind of page you are on : taxonomy page or node page
   * @return mixed|string
   */
  protected function isRouteTaxoOrNode(){
    $path = "";
    $routeObject = $this->routeMatch->getRouteObject();
    if ($routeObject === null){
      $path = 'node';
    }
    $routePath = $routeObject->getPath();
    $path = explode("/",$routeObject->getPath());
    return $path[1];
  }

  /**
   * With this method you can get links built for a taxonomy page displaying
   * In the parameter you need to send a list of terms id loaded
   * @param array|null $terms_loaded
   * @return array
   */
  protected function createTaxonomyLinksForTaxonomyPage(?array $terms_loaded): array
  {
  $links = [];
  $currentPageId = $this->routeMatch->getRawParameter(self::ENTITY_TYPE);

  foreach ($terms_loaded as $term){
    if($currentPageId === $term->id() ) {
      // define the class name
      $attributes = ['attributes' => ['class' => ['active']]];

      // build the link reference
     $url_object_with_attributes = Url::fromRoute('entity.taxonomy_term.canonical', array('taxonomy_term'=>$term->id()), $attributes);
      $link = $this->setlinkBuiltWithUrlAndTitle($term, $url_object_with_attributes);
      $links[] = $link;
    } else {
      $url_object = Url::fromRoute('entity.taxonomy_term.canonical', array('taxonomy_term'=>$term->id()));
      $link = $this->setlinkBuiltWithUrlAndTitle($term, $url_object);
      $links[] = $link;
    }
  }
  return $links;
}

  /**
   * @param $term_loaded
   * @param Url $url_object
   * @return array
   */
  protected function setlinkBuiltWithUrlAndTitle($term_loaded, Url $url_object): array
  {
    $link = Link::fromTextAndUrl($term_loaded->label(), $url_object);
    return  $link->toRenderable();
  }

  /**
   * With this method you can get links built for a node page displaying
   * In the parameter you need to send a list of terms id loaded
   * @param $terms_loaded
   * @return array
   */
  protected function createTaxonomyLinksForNodesPage($terms_loaded): array
  {
    $links = [];
    foreach ($terms_loaded as $node_loaded) {
      $url_object = Url::fromRoute('entity.taxonomy_term.canonical', array('taxonomy_term'=>$node_loaded->id()));
      $link = Link::fromTextAndUrl($node_loaded->label(), $url_object);
      $link = $link->toRenderable();
      $links[] = $link;
    }
    return $links;
  }

  //************************* Public Functions to get links ****************************



}

