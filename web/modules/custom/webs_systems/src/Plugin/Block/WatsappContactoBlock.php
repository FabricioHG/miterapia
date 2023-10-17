<?php

namespace Drupal\webs_systems\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Extension\ModuleHandlerInterface;


/**
 * Provides a watsapp contacto block.
 *
 * @Block(
 *   id = "webs_systems_watsapp_contacto",
 *   admin_label = @Translation("Whatsapp contacto"),
 *   category = @Translation("Webs_systems")
 * )
 */
class WatsappContactoBlock extends BlockBase implements ContainerFactoryPluginInterface  {

  /**
   * The module handler.
   *
   * @var \Drupal\Core\Extension\ModuleHandlerInterface
   */
  protected $moduleHandler;

  /**
   * Constructs a new CustomModulePathBlock instance.
   *
   * @param array $configuration
   *   A configuration array containing information about the plugin instance.
   * @param string $plugin_id
   *   The plugin_id for the plugin instance.
   * @param mixed $plugin_definition
   *   The plugin implementation definition.
   * @param \Drupal\Core\Extension\ModuleHandlerInterface $module_handler
   *   The module handler.
   */
  public function __construct(array $configuration, $plugin_id, $plugin_definition, $module_handler) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->moduleHandler = $module_handler;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('module_handler')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function defaultConfiguration() {
    return [
      'texto' => $this->t('¡Hola! Estoy interesado en obtener más información.'),
      'num_cel' => $this->t('1234567890'),
      'label_display' => FALSE,
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function blockForm($form, FormStateInterface $form_state) {
    $form['texto'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Texto del mensaje inicial'),
      '#default_value' => $this->configuration['texto'],
    ];

    $form['phone_number'] = array(
      '#type' => 'tel',
      '#title' => t('Phone Number'),
      '#default_value' => $this->configuration['num_cel'], // Valor por defecto si lo necesitas
      '#required' => TRUE, // Campo obligatorio
      '#description' => t('Please enter your phone number. Do not include zeros, parentheses, or hyphens when adding the phone number in this format. Examples:
Use: 3342993438.'),
    );
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function blockSubmit($form, FormStateInterface $form_state) {
    $this->configuration['texto'] = $form_state->getValue('texto');
    $this->configuration['num_cel'] = $form_state->getValue('phone_number');
  }

  /**
   * {@inheritdoc}
   */
  public function build() {

    // Obtener la ruta del directorio de tu módulo.
    if ($this->moduleHandler->moduleExists('webs_systems')) {
      $module_path = $this->moduleHandler->getModule('webs_systems')->getPath();
    }
    
    $image_url ='/'.$module_path.'/img/whatsApp_icon.png';

    $num_cel = $this->configuration['num_cel'];
    $msj = $this->configuration['texto'];

    $link_url = 'https://wa.me/'.$num_cel.'?text='.$msj;
    
    $image_markup = '<a href="' . $link_url . '" aria-label="Chat on WhatsApp"><img class="ico_whats" src="' . $image_url . '" alt="Whatsapp contact"></a>';

    $build['content'] = [
      '#markup' => $this->t($image_markup),
    ];

    $build['#attached']['library'][] = 'webs_systems/webs_systems';
    
    return $build;
  }

}
