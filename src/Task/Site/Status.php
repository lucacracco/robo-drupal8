<?php

namespace Lucacracco\Drupal8\Robo\Task\Site;

/**
 * Robo task base: Status site.
 */
class Status extends SiteTask {

  /**
   * {@inheritdoc}
   */
  public function run() {
    $this->collection->add(
      $this->collectionBuilder()->taskDrushStatus()
    );
    return parent::run();
  }

}
