<?php

namespace Drupal\cp22_escp_socials\Manager;

use Drupal\cp22_escp_global\Manager\BasicListOfTaxonomyTermsManager;

class SocialsTermsManager extends BasicListOfTaxonomyTermsManager
{

  /**
   *   With this method we calibrate the vocabulary to access on getbuiltPublishedTermsListByWeight ()
   */
  protected function getVocabularyId(): string {
    return 'social_network';
  }


}
