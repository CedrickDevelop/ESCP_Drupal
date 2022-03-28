<?php


namespace Drupal\cp22_escp_global\Plugin\Block;

use Drupal\Core\Block\Annotation\Block;
use Drupal\Core\Block\BlockBase;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Drupal\Core\Url;
use Drupal\cp22_escp_article\Manager\ArticleNodeManager;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Provides a partners block list.
 *
 * @Block(
 *   id = "cp22_escp_global_header_title",
 *   admin_label = @Translation("HeaderTitleBlock"),
 *   category = @Translation("Custom")
 * )
 */
class HeaderTitleBlock extends BlockBase implements ContainerFactoryPluginInterface
{

  /**
   * @var ArticleNodeManager
   */
  protected $articleNodeManager;


  /** Instanciate all the class needed to build */
  public function __construct(
    array                 $configuration,
                          $plugin_id,
                          $plugin_definition)
  {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
  }

  /**
   * @param ContainerInterface $container
   * @param array $configuration
   * @param $plugin_id
   * @param $plugin_definition
   * @return HeaderTitleBlock
   */
  public static function create(ContainerInterface $container,
                                array $configuration, $plugin_id, $plugin_definition): HeaderTitleBlock
  {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition
    );
  }

  /**
   * Method to build the slider of partners on all menu footer (not partners page)
   * @return array
   */
  public function build(): array
  {

    $attributes = [
      'attributes' => [
        'class' => [
          'btn', 'btn-success'
        ],
        'id' => 'monid'
      ],
    ];

    return [
      '#type' => 'html_tag',
      '#tag' => 'h1',
      '#attributes' => array('class' => 'titre'),
      'children' => [
        [
          '#type' => 'link',
          '#url'  =>  Url::fromRoute('cp22_escp_home.home', [], $attributes),
          '#title' => [
            'children' => [
              ['#type' => 'html_tag',
                '#tag' => 'span',
                '#attributes' => array('class' => 'bold'),
                '#value'  =>'Executive'],
              ['#type' => 'html_tag',
                '#tag' => 'span',
                '#attributes' => array('class' => 'thin'),
                '#value'  =>'Business'],
              ['#type' => 'html_tag',
                '#tag' => 'span',
                '#attributes' => array('class' => 'bold'),
                '#value'  =>'Insights'],
            ]

          ]

        ],
      ],
    ];

  }
}
