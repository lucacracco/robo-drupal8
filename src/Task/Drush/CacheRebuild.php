<?php

namespace Lucacracco\Drupal8\Robo\Task\Drush;

/**
 * Robo task: Rebuild caches.
 */
class CacheRebuild extends DrushTask {

  /**
   * {@inheritdoc}
   */
  public function run() {
    $this->collection->add(
      $this->drushStack()
        ->drush('cache-rebuild')
    );
    return parent::run();
  }

}
