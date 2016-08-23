<?php

use LucaCracco\Robo\Task\Drupal8\Drupal8RoboFile;

/**
 * This is project's console commands configuration for Robo task runner.
 *
 * @see http://robo.li/
 */
class RoboFile extends Drupal8RoboFile {


  public function buildNew($opts = self::OPTS) {

    /** @var \LucaCracco\Robo\Task\Drupal8\Drupal8Stack $drupal8_stack */
    $drupal8_stack = parent::buildNew($opts);

    // ...

    // Clear cache example.
    $drupal8_stack
      ->getInfoSite()
      ->rebuildCache()
      ->run();

  }

  /**
   * {@inheritdoc}
   */
  public function statusSite($opts = self::OPTS) {
    parent::statusSite($opts);

    $this->say("Custom alter command");
    // ...

  }

}
