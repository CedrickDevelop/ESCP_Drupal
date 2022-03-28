<?php


namespace Drupal\cp22_escp_home\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Cache\CacheBackendInterface;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Drupal\cp22_escp_article\Manager\ArticleNodeManager;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Provides a partners block list.
 *
 * @Block(
 *   id = "cp22_escp_home_homepage_slider",
 *   admin_label = @Translation("HomepageSlider"),
 *   category = @Translation("Custom")
 * )
 */
class HomepageSlider extends BlockBase implements ContainerFactoryPluginInterface
{

  /**
   * @var \Drupal\Core\Cache\CacheBackendInterface
   */
  protected $cacheBackend;
  /**
   * @var ArticleNodeManager
   */
  protected $articleNodeManager;


  /** Instanciate all the class needed to build */
  public function __construct(
    array                 $configuration,
                          $plugin_id,
                          $plugin_definition,
    CacheBackendInterface $cacheBackend,
    ArticleNodeManager    $articleNodeManager)
  {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->cacheBackend = $cacheBackend;
    $this->articleNodeManager = $articleNodeManager;
  }

  /**
   * @param \Symfony\Component\DependencyInjection\ContainerInterface $container
   * @param array $configuration
   * @param $plugin_id
   * @param $plugin_definition
   *
   * @return \Drupal\cp22_saulnier_partners\Plugin\Block\HomepageSlider
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition): HomepageSlider
  {
    $cache = $container->get('cache.data');
    $articleNode = $container->get('Drupal\cp22_escp_article\Manager\ArticleNodeManager');
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $cache,
      $articleNode
    );
  }

  /**
   * Method to build the slider of partners on all menu footer (not partners page)
   * @return array
   */
  public function build(): array
  {

//    $terms = [];
//    // Creation du cache
//    $cid = 'cp22_saulnier_partners_cache';
//    $cache = $this->cacheBackend->get($cid);
//
//    if($cache){
//      $terms = $cache->data;
//    } else {
//      $terms = $this->partnersTermsManager->getbuiltPublishedTermsListByWeight();
//      $this->cacheBackend->set($cid, $terms,cacheBackendInterface::CACHE_PERMANENT, ['terms:partners']);
//    }
    $node = $this->articleNodeManager->getNodesTest();


    return [
      "#theme" => "homepage_slider",
      "#slider_homepage" => $node
    ];
  }
}
