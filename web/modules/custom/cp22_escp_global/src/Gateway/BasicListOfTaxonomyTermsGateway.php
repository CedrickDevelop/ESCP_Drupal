<?php

namespace Drupal\cp22_escp_global\Gateway;

use Drupal\Component\Plugin\Exception\InvalidPluginDefinitionException;
use Drupal\Component\Plugin\Exception\PluginNotFoundException;
use Drupal\Core\Entity\EntityTypeManager;
use Drupal\node\NodeInterface;


/**
 *  Gateway class to Fetch Taxonomy term from the database
 */
class BasicListOfTaxonomyTermsGateway implements BasicListOfTaxonomyTermsGatewayInterface
{
  const ENTITY_TYPE_ID = 'taxonomy_term';

  /**
   * @var EntityTypeManager
   */
  protected $entityTypeManager;

  /**
   * This construction call EntityTypeManager to get taxonomy term on database
   *
   * @param EntityTypeManager $entityTypeManager
   */
  public function __construct(EntityTypeManager $entityTypeManager) {
    $this->entityTypeManager = $entityTypeManager;
  }

  /**
   *  Method to fetch Taxonomy published sort by weight with $vocabulary id as condition
   * @param string $vid
   * @return array
   * @throws InvalidPluginDefinitionException
   * @throws PluginNotFoundException
   */
  public function fetchPublishedTermsByWeight(string $vid): array {
    return $this->entityTypeManager->getStorage(self::ENTITY_TYPE_ID)
      ->getQuery()
      ->condition('vid', $vid)
      ->condition('status', NodeInterface::PUBLISHED)
      ->sort('weight', 'ASC')
      ->execute();
  }



}
