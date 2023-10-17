<?php

namespace Drupal\webs_systems\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides an example block.
 *
 * @Block(
 *   id = "webs_systems_example",
 *   admin_label = @Translation("Slide de imagenes Multiple infinito"),
 *   category = @Translation("Webs_systems")
 * )
 */
class ExampleBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {

  	$nids = \Drupal::entityQuery('node')
      ->condition('type', 'carousel_multi_item') // Cambia 'article' por el nombre de tu tipo de contenido
      ->condition('status', 1) // Solo nodos publicados
      ->accessCheck()
      ->execute();

   	$nodes = \Drupal\node\Entity\Node::loadMultiple($nids);

   	$images = [];

   	foreach ($nodes as $node) {
      $image_field = $node->get('field_imagen_multi_item'); // Cambia 'field_imagen_destacada' al nombre de tu campo de imagen
      if (!$image_field->isEmpty()) {
        $image_entity = $image_field->entity;
        $url_full = $image_entity->getFileUri();
       
        $subString = 'public:/';
        $url = str_replace($subString, '', $url_full);

        $images[] = $url;
      }
    }




    $titulo = 'WS F';
    $url_imgs = $images;

    // Cargar la biblioteca.
    $build['#attached']['library'][] = 'webs_systems/webs_systems';

    // Agregar configuración de renderización.
    $build['#theme'] = 'slide_multi_infin';
    $build['#titulo'] = $titulo;
    $build['#url_imgs'] = $url_imgs;


    return $build;
  }

}







