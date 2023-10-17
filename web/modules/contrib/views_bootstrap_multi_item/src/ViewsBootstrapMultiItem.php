<?php

namespace Drupal\views_bootstrap_multi_item;

use Drupal\Component\Utility\Html;
use Drupal\views\ViewExecutable;

/**
 * The primary class for the Views Bootstrap Multi Item module.
 *
 * Provides many helper methods.
 *
 * @ingroup utility
 */
class ViewsBootstrapMultiItem {

  /**
   * Returns the theme hook definition information.
   */
  public static function getThemeHooks() {
    $hooks['views_bootstrap_carousel'] = [
      'preprocess functions' => [
        'template_preprocess_views_bootstrap_multi_item_carousel',
        'template_preprocess_views_view_multi_item',
      ],
      'file' => 'views_bootstrap_multi_item.theme.inc',
    ];

    return $hooks;
  }

  /**
   * Get unique element id.
   *
   * @param \Drupal\views\ViewExecutable $view
   *   A ViewExecutable object.
   *
   * @return string
   *   A unique id for an HTML element.
   */
  public static function getUniqueId(ViewExecutable $view) {
    $id = $view->storage->id() . '-' . $view->current_display;
    return Html::getUniqueId('views-bootstrap-' . $id);
  }
}

