<?php

namespace Drupal\webs_systems\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Returns responses for Webs_systems routes.
 */
class WebsSystemsController extends ControllerBase {

  /**
   * Builds the response.
   */
  public function build() {

    $build['content'] = [
      '#type' => 'item',
      '#markup' => $this->t('It works!'),
    ];

    return $build;
  }

}
