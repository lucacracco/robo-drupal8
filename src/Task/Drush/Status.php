<?php

namespace Lucacracco\Drupal8\Robo\Task\Drush;

/**
 * Robo task: Status site.
 */
class Status extends DrushTask {

  protected $format = NULL;

  /**
   * Set Format to response.
   *
   * @param $format
   */
  public function format($format) {
    $this->format = $format;
  }

  /**
   * {@inheritdoc}
   */
  public function run() {
    if (isset($this->format)) {
      $this->drushStack()
        ->argForNextCommand('--format=' . escapeshellarg($this->format));
    }
    return $this->drushStack()
      ->drush('core-status')
      ->run();
  }

}
