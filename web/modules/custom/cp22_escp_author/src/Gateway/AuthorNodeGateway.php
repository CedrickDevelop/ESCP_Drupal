<?php

namespace Drupal\cp22_escp_author\Gateway;

use Drupal\adimeo_tools\Service\LanguageService;
use Drupal\Component\Plugin\Exception\InvalidPluginDefinitionException;
use Drupal\Component\Plugin\Exception\PluginNotFoundException;
use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\node\NodeInterface;

/**
 *  This class fetch the node author in the database
 */
class AuthorNodeGateway
{
  //********* CONSTANTES **************************
  const ENTITY_TYPE_NODE = 'node';
  const AUTHOR_BUNDLE = 'author';

  //********* PROPRIETES **************************
  /**
   * @var LanguageService
   */
  protected $languageService;

  /**
   * @var EntityStorageInterface
   */
  protected $getStorage;

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
    $this->getStorage = $entityTypeManager->getStorage(self::ENTITY_TYPE_NODE);
    $this->languageService = $languageService->getCurrentLanguageId();
  }

  //******************* METHODES ****************************************

  /**
   *  This method fetch all nodes author (published and not published)
   * order by name asc and adapted to languages.
   * @return array
   */
  public function fetchNodesAuthorSortAsc(): array{
    $query = $this->getStorage->getQuery();
    $nodesId = $query->condition('type', self::AUTHOR_BUNDLE)
          ->condition('langcode', $this->languageService)
          ->sort('title', 'ASC')
          ->execute();
    Return $this->getStorage->loadMultiple($nodesId);
  }

  /**
   * This method fetch all nodes author (published and not published) and adapted to languages.
   * These nodes filtred by a node id
   * @param string|null|$nid
   * @return array
   */
  public function fetchNodesAuthorWithLanguagesByNid(?string $nid): array
  {
    $query = $this->getStorage->getQuery();
    $nodesId = $query->condition('type', self::AUTHOR_BUNDLE)
          ->condition('langcode', $this->languageService)
          ->condition('nid', $nid)
          ->execute();

    return $this->getStorage->loadMultiple($nodesId);

  }


}
