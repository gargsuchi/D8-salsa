<?php

namespace Drupal\govind_exercise2\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Config\ConfigFactoryInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class ConfigFrom.
 */
class ConfigFrom extends ConfigFormBase {

  /**
   * Drupal\Core\Config\ConfigFactoryInterface definition.
   *
   * @var \Drupal\Core\Config\ConfigFactoryInterface
   */
  protected $configFactory;
  /**
   * Constructs a new ConfigFrom object.
   */
  public function __construct(
    ConfigFactoryInterface $config_factory
    ) {
    parent::__construct($config_factory);
        $this->configFactory = $config_factory;
  }

  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('config.factory')
    );
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      'govind_exercise2.configfrom',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'config_from';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('govind_exercise2.configfrom');
    $form['title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Title'),
      '#maxlength' => 64,
      '#size' => 64,
      '#default_value' => $config->get('title'),
    ];
    $form['date'] = [
      '#type' => 'date',
      '#title' => $this->t('Date'),
      '#default_value' => $config->get('date'),
    ];
    $form['category'] = [
      '#type' => 'checkboxes',
      '#title' => $this->t('Category'),
      '#options' => [
        'Category1' => $this->t('Category1'),
        'Category2' => $this->t('Category2'),
        'Category3' => $this->t('Category3'),
        'Category4' => $this->t('Category4'),
        'Category5' => $this->t('Category5'),
        'Category6' => $this->t('Category6')
      ],
      '#default_value' => $config->get('category'),
    ];
    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    parent::validateForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    parent::submitForm($form, $form_state);

    $this->config('govind_exercise2.configfrom')
      ->set('title', $form_state->getValue('title'))
      ->set('date', $form_state->getValue('date'))
      ->set('category', $form_state->getValue('category'))
      ->save();
  }

}
