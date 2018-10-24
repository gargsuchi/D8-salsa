<?php

namespace Drupal\page_logger\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Logger\LoggerChannelFactoryInterface;

/**
 * Class PageLoggerController.
 */
class PageLoggerController extends ControllerBase {

  /**
   * Drupal\Core\Logger\LoggerChannelFactoryInterface definition.
   *
   * @var \Drupal\Core\Logger\LoggerChannelFactoryInterface
   */
  protected $loggerFactory;

  /**
   * Constructs a new PageLoggerController object.
   */
  public function __construct(LoggerChannelFactoryInterface $logger_factory) {
    $this->loggerFactory = $logger_factory;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('logger.factory')
    );
  }

  /**
   * Logger.
   *
   * @return string
   *   Return Hello string.
   */
  public function logger() {
    $this->loggerFactory->get('d8-salsa')->notice('Simple page is displayed');
    return [
      '#type' => 'markup',
      '#markup' => $this->t('Implement method: logger')
    ];
  }

}
