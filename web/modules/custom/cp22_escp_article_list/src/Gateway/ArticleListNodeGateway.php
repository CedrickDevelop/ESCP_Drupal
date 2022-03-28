<?php

namespace Drupal\cp22_escp_article_list\Gateway;

use Drupal\adimeo_tools\Service\LanguageService;
use Drupal\Component\Plugin\Exception\InvalidPluginDefinitionException;
use Drupal\Component\Plugin\Exception\PluginNotFoundException;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\node\NodeInterface;

/**
 *  This class fetch the node article list in the database
 */
class ArticleListNodeGateway implements ArticleListNodeGatewayInterface
{

  //********* CONSTANTES **************************
  const ENTITY_TYPE = 'node';
  const NODE_BUNDLE_TYPE = "article_list";

  //********* PROPRIETES **************************
  /**
   * @var EntityStorageInterface
   */
  protected $getStorage;
  /**
   * @var string
   */
  protected $languageService;


  //********* CONSTRUCTEUR **************************
  /**
   *  This construct get EntityTypeManager to get data in the database
   * @param EntityTypeManagerInterface $entityTypeManager
   * @param LanguageService $languageService
   * @throws InvalidPluginDefinitionException
   * @throws PluginNotFoundException
   */
  public function __construct(
    EntityTypeManagerInterface $entityTypeManager,
    LanguageService $languageService)
  {
    $this->getStorage = $entityTypeManager->getStorage(self::ENTITY_TYPE);
    $this->languageService = $languageService->getCurrentLanguageId();
  }

  //******************* METHODES *****************************************

  /**
   *  This method fetch the last node article list published adapted to languages.
   * @return array
   */
  public function fetchTheLastChangedArticleListPagePublished(): array
  {
    $query = $this->getStorage->getQuery();
    $nodesId = $query->condition('type', self::NODE_BUNDLE_TYPE)
      ->condition('langcode', $this->languageService)
      ->condition('status', NodeInterface::PUBLISHED)
      ->sort('changed', 'DESC')
      ->range(0,1)
      ->execute();
    Return  $this->getStorage->loadMultiple($nodesId);
  }
}
