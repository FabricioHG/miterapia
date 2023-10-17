<?php

/**
 * @file
 * Preprocessors and helper functions to make theming easier.
 */

use Drupal\views_bootstrap_multi_item\ViewsBootstrapMultiItem;
use Drupal\Core\Template\Attribute;

/**
 * Prepares variables for views carousel template.
 *
 * Default template: views-bootstrap-carousel.html.twig.
 *
 * @param array $vars
 *   An associative array containing:
 *   - view: A ViewExecutable object.
 *   - rows: The raw row data.
 */
function template_preprocess_views_bootstrap_multi_item(array &$vars) {
  $vars['#attached']['library'][] =  'views_bootstrap_multi_item/components';

  $view = $vars['view'];
  $vars['id'] = ViewsBootstrapMultiItem::getUniqueId($view);
  $vars['attributes']['class'][] = 'views-bootstrap-media-object';
  $vars['attributes']['class'][] = 'media-list';

  // Carousel options.
  $vars['interval'] = $view->style_plugin->options['interval'];
  $vars['navigation'] = $view->style_plugin->options['navigation'];
  $vars['indicators'] = $view->style_plugin->options['indicators'];
  $vars['pause'] = $view->style_plugin->options['pause'] ? 'hover' : FALSE;
  $vars['wrap'] = $view->style_plugin->options['wrap'];
  $vars['effect'] = $view->style_plugin->options['effect'];
  $vars['use_caption'] = $view->style_plugin->options['use_caption'];
  $vars['ride'] = $view->style_plugin->options['ride'];

  // Carousel rows.
  $image = $view->style_plugin->options['image'];
  $title = $view->style_plugin->options['title'];
  $description = $view->style_plugin->options['description'];
  $fieldLabels = $view->display_handler->getFieldLabels(TRUE);

  $vars['row_class'] = $view->style_plugin->options['row_class'];

  foreach ($vars['rows'] as $id => $row) {
    $vars['rows'][$id] = [];
    $vars['rows'][$id]['image'] = $view->style_plugin->getField($id, $image);
    $vars['rows'][$id]['title'] = $view->style_plugin->getField($id, $title);
    $vars['rows'][$id]['description'] = $view->style_plugin->getField($id, $description);
    // Add any additional fields to result.
    foreach (array_keys($fieldLabels) as $label) {
      if (!in_array($label, [$image, $title, $description])) {
        $vars['rows'][$id][$label] = $view->style_plugin->getField($id, $label);
      }
    }
  }

}
