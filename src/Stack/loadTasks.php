<?php

namespace Lucacracco\Drupal8\Robo\Stack;

/**
 * Class loadTasks
 * @package Lucacracco\Drupal8\Robo\Stack
 */
trait loadTasks {

  /**
   * Get Custom Drush Stack.
   *
   * @param string $path_to_drush
   *   Path drushPath.
   *
   * @return CustomDrushStack
   */
  protected function taskCustomDrushStack($path_to_drush = 'drushPath') {
    return $this->task(CustomDrushStack::class, $path_to_drush);
  }

}
