<?php

namespace Drupal\cp22_escp_themes\Manager;

use Drupal\cp22_escp_global\Manager\BasicListOfTaxonomyTermsManager;
/**
 *  Class to get the taxonomy term themes
 *  Connected to the global abstract manager.
 *  Can use all the methods of the parent BasicListOfTaxonomyTermManager
 */
class ThemesTermManager extends BasicListOfTaxonomyTermsManager
{
  const VID = 'themes';

  /**
   *  With this method we calibrate the vocabulary to access on getbuiltPublishedTermsListByWeight ()
   */
  protected function getVocabularyId(): string {
    return self::VID;
  }

}


