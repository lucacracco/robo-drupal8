<?php

namespace Lucacracco\Drupal8\Robo\Task\Drush;

/**
 * Robo task: Export Drupal configuration.
 */
class ConfigExport extends DrushTask {

  /**
   * Destination dir.
   *
   * @var string
   */
  protected $destination = NULL;

  /**
   * A list of modules to ignore during export.
   *
   * @var null|string
   */
  protected $skipModules = NULL;

  /**
   * Set destination to save configuration.
   *
   * @param string $destination
   *   Path destination dir.
   *
   * @return $this
   */
  public function setDestination($destination) {
    $this->destination = $destination;
    return $this;
  }

  /**
   * Skip modules configurations.
   *
   * @param string $skip_modules
   *   A list of modules to ignore during export.
   *
   * @return $this
   */
  public function setSkipModules($skip_modules) {
    $this->skipModules = $skip_modules;
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function run() {
    if (isset($this->skipModules)) {
      $this->drushStack()
        ->argForNextCommand("--skip-modules=" . $this->skipModules);
    }
    if (isset($this->destination)) {
      $this->drushStack()
        ->argForNextCommand("--destination=" . $this->destination);
    }
    $this->collection->add(
      $this->drushStack()
        ->drush('config-export')
    );
    return parent::run();
  }

}
