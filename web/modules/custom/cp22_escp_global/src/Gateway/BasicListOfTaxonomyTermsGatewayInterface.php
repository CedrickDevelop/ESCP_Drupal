<?php

namespace Drupal\cp22_escp_global\Gateway;

interface BasicListOfTaxonomyTermsGatewayInterface
{

  /**
   * Method to fetch Taxonomy published sort by weight with $vocabulary id as condition
   * @param string $vid
   * @return array
   */
  public function fetchPublishedTermsByWeight(string $vid): array;

}
