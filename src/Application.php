<?php

namespace Lucacracco\Drupal8\Robo;

use \Robo\Application as RoboApplication;
use Symfony\Component\Console\Input\InputOption;

/**
 * Class Application custom.
 *
 * @package Project\Robo
 */
class Application extends RoboApplication {

  /**
   * @param string $name
   * @param string $version
   */
  public function __construct($name, $version) {
    parent::__construct($name, $version);

    // Increase a progress-delay
    $this->getDefinition()
      ->getOption('progress-delay')->setDefault(180);

    $this->getDefinition()
      ->addOption(
        new InputOption('--site', '-s', InputOption::VALUE_REQUIRED, 'URI of the drupal site to use (only needed in multisite environments).', 'default')
      );

  }

}