<?php

namespace Drupal\cp22_escp_global\Manager;

use Drupal\adimeo_tools\Service\LanguageService;
use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\cp22_escp_global\Gateway\BasicListOfTaxonomyTermsGateway;
use Drupal\cp22_escp_global\Gateway\BasicListOfTaxonomyTermsGatewayInterface;

abstract class BasicListOfTaxonomyTermsManager
{
  const ENTITY_TYPE_ID = 'taxonomy_term';

  /**
   * Connected to the abstract method get vocabulary id
   * This is the vid of the texonomy term
   * @var
   */
  protected $vocabularyId;

  /**
   * @var EntityTypeManagerInterface
   */
  protected $entityTypeManager;


  protected $BasicTaxonomyGateway;
  /**
   * @var LanguageService
   */
  protected $languageService;


  /**
   * This construction call :
   * EntityTypeManager to build the taxonomy term   *
   * The BasicListOfTaxonomy to access on method and fetch the taxonomy terms
   * @param EntityTypeManagerInterface $entityTypeManager
   * @param BasicListOfTaxonomyTermsGateway $basicTaxonomyGateway
   */
  public function __construct(
    EntityTypeManagerInterface $entityTypeManager,
    BasicListOfTaxonomyTermsGateway $basicTaxonomyGateway) {
    $this->entityTypeManager = $entityTypeManager;
    $this->BasicTaxonomyGateway = $basicTaxonomyGateway;

    $this->vocabularyId = $this->getVocabularyId();
  }


  /**
   *  Method to select the vocabulary of the taxonomy query (used as $vid in the gateway)
   */
  abstract protected function getVocabularyId();


  /**
   * This method built taxonomy term to use them on the view.
   * They are filtred by vocabulary id, published and sort by weight
   *
   * @return array
   * @throws \Drupal\Component\Plugin\Exception\InvalidPluginDefinitionException
   * @throws \Drupal\Component\Plugin\Exception\PluginNotFoundException
   */
  public function getbuiltPublishedTermsListByWeight(): array {
    $TermsBuilded = [];
    $termIds = $this->BasicTaxonomyGateway->fetchPublishedTermsByWeight($this->vocabularyId);

    if (!empty($termIds)) {
      $view_builder = $this->entityTypeManager
        ->getViewBuilder(self::ENTITY_TYPE_ID);

      $terms = $this->entityTypeManager
        ->getStorage(self::ENTITY_TYPE_ID)
        ->loadMultiple($termIds);


      foreach ($terms as $term) {
        $TermsBuilded[] = $view_builder->view($term, "teaser_list_page");
      }
    }
    return $TermsBuilded;
  }

  public function getPublishedTermsListByWeight(): array {

    $termIds = $this->BasicTaxonomyGateway->fetchPublishedTermsByWeight($this->vocabularyId);

    if (empty($termIds)) {
      return $term = [];
    }
    return $this->entityTypeManager
        ->getStorage(self::ENTITY_TYPE_ID)
        ->loadMultiple($termIds);
  }

}
