<?php

namespace Drupal\cp22_escp_themes\Plugin\Block;



use Drupal\Core\Block\BlockBase;
use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Drupal\Core\Routing\RouteMatchInterface;
use Drupal\cp22_escp_socials\Manager\SocialsTermsManager;
use Drupal\cp22_escp_themes\Manager\ThemesTermManager;
use Drupal\cp22_escp_themes\Manager\ThemesTermManagerForBlock;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Provides a block themes to display on pages.
 *
 * @Block(
 *   id = "cp22_escp_themes_term_block",
 *   admin_label = @Translation("ThemesTermBlock"),
 *   category = @Translation("Custom")
 * )
 */
class ThemesTermBlock  extends BlockBase implements ContainerFactoryPluginInterface {



  /**
   * @var EntityTypeManagerInterface
   */
  protected $entityTypeManager;
  /**
   * @var ThemesTermManager
   */
  protected $themesTermManager;
  /**
   * @var ThemesTermManagerForBlock
   */
  protected $themesTermManagerForBlock;
  /**
   * @var RouteMatchInterface
   */
  protected $routeMatch;

  /**
   *  Basic constructor to instantiate the class needed
   *
   * @param array $configuration
   * @param $plugin_id
   * @param $plugin_definition
   * @param EntityTypeManagerInterface $entityTypeManager
   */
  public function __construct(
    array                      $configuration,
                               $plugin_id,
                               $plugin_definition,
    EntityTypeManagerInterface $entityTypeManager,
    ThemesTermManager $themesTermManager,
    ThemesTermManagerForBlock $themesTermManagerForBlock,
    RouteMatchInterface $routeMatch) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->entityTypeManager = $entityTypeManager;
    $this->themesTermManager = $themesTermManager;
    $this->themesTermManagerForBlock = $themesTermManagerForBlock;
    $this->routeMatch = $routeMatch;
  }

  public function build(): array {
//    return $this->themesTermManager->getbuiltPublishedTermsListByWeight();
    return $this->themesTermManagerForBlock->getLinksForBlockThemesTermAdaptedForNodesAndTaxonomyPages();
  }





  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    $themesTermManager = $container->get(ThemesTermManager::class);
    $themesTermManagerForBlock = $container->get(ThemesTermManagerForBlock::class);
    $routeMatch = $container->get( 'current_route_match');
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('entity_type.manager'),
      $themesTermManager,
      $themesTermManagerForBlock,
      $routeMatch
    );
  }


}


//}
