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
   * @param string $pathToDrush
   *   Path drush.
   *
   * @return CustomDrushStack
   */
  protected function taskCustomDrushStack($pathToDrush = 'drush') {
    return $this->task(CustomDrushStack::class, $pathToDrush);
  }

}
