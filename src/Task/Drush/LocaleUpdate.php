<?php

namespace Lucacracco\Drupal8\Robo\Task\Drush;

/**
 * Robo task: Update localizations.
 */
class LocaleUpdate extends DrushTask {

  /**
   * {@inheritdoc}
   */
  public function run() {
    $this->collection->add(
      $this->drushStack()
      ->drush('locale-update')
    );
    return parent::run();
  }

}
