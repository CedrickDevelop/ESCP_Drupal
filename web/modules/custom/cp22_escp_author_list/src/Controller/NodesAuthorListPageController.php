<?php

namespace Drupal\cp22_escp_author_list\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Controller\TitleResolver;
use Drupal\cp22_escp_article\Manager\ArticleNodeManager;
use Drupal\cp22_escp_author\Manager\AuthorNodeManager;

/** Controler for the list page of authors */
class NodesAuthorListPageController extends ControllerBase {

  /**
   * @var AuthorNodeManager
   */
  protected $authorNodeManager;

  /**
   * @param AuthorNodeManager $authorNodeManager
   */
  public function __construct(
    AuthorNodeManager $authorNodeManager
  )
  {
    $this->authorNodeManager = $authorNodeManager;
  }

  /**
   * @return array
   */
  public function content(): array
  {
    $nodesAuthor = $this->authorNodeManager->getNodesAuthorSortAsc();

    return [
      "#theme"  => "author_list_page_full",
      "#nodes_article_by_theme" => $nodesAuthor,
      "#title"      => $this->t('all the authors')
    ];
  }

}
