<?php

namespace Drupal\cp22_escp_global\Plugin\Block;

use Drupal\Core\Block\Annotation\Block;
use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormBuilder;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\cp22_escp_global\Form\NewsLetterForm;


/**
 * Provides a newsletter block.
 *
 * @Block(
 *   id = "cp22_escp_global_newsLetter",
 *   admin_label = @Translation("NewsLetter"),
 *   category = @Translation("Custom")
 * )
 */
class NewsLetterBlock extends BlockBase implements ContainerFactoryPluginInterface
{
  /**
   * @var FormBuilder
   */
  protected $formBuilder;


  /**
   *  Basic constructor to instantiate the class needed
   *
   * @param array $configuration
   * @param $plugin_id
   * @param $plugin_definition
   */
  public function __construct(
    array $configuration,
          $plugin_id,
          $plugin_definition,
    FormBuilder $formBuilder)
  {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->formBuilder = $formBuilder;
  }

  /**
   * @return array
   */
  public function build(): array
  {
    return $this->formBuilder->getForm(NewsLetterForm::class);
  }


  /**
   * @param ContainerInterface $container
   * @param array $configuration
   * @param $plugin_id
   * @param $plugin_definition
   * @return NewsLetterBlock|static
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition)
  {
    $formBuilder = $container->get('form_builder');

    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $formBuilder
    );
  }



}

