<?php

namespace Lucacracco\Drupal8\Robo\Common;

use Lucacracco\Drupal8\Robo\Utility\Configurations;
use Lucacracco\Drupal8\Robo\Utility\PathResolver;

/**
 * Trait for load a Custom Drush Stack.
 *
 * @package Lucacracco\Drupal8\Robo\Common
 */
trait CustomDrushStack {

  /**
   * Custom Drush stack.
   *
   * @var \Lucacracco\Drupal8\Robo\Stack\CustomDrushStack
   */
  protected $drushStack = NULL;

  /**
   * @return mixed
   */
  protected function getDrupalUri() {
    return $this->drushStack->getUri();
  }

  /**
   * @param mixed $drupalUri
   * @return $this
   */
  protected function setDrupalUri($drupalUri) {
    $this->drushStack->uri($drupalUri);
    return $this;
  }

  /**
   * @param mixed $drupalRootDirectory
   * @return $this
   */
  protected function setDrupalRootDirectory($drupalRootDirectory) {
    $this->drushStack->drupalRootDirectory($drupalRootDirectory);
    return $this;
  }

  /**
   * DrushStack used.
   *
   * @param string|null $drupal_site_uri
   *   Target a site.
   *
   * @return \Lucacracco\Drupal8\Robo\Stack\CustomDrushStack
   *   DrushStack with URI configured.
   */
  protected function drushStack($drupal_site_uri = 'default') {

    // Init drush.
    if (!isset($this->drushStack)) {
      $this->drushStack = $this->getDrushStack(PathResolver::drush(), PathResolver::docroot());
    }

    // Override uri.
    if ($this->drushStack->getUri() != $drupal_site_uri) {
      $this->setDrupalUri($drupal_site_uri);
    }

    return $this->drushStack;
  }

  /**
   * Get DrushStack.
   *
   * If you want use Boedah\Robo\Task\Drush\DrushStack, change TaskCustomDrushStack.
   *
   * @param string $drush_path
   *   Drush path used.
   * @param string $drupal_root_directory
   *   Drupal web root directory.
   *
   * @return \Lucacracco\Drupal8\Robo\Stack\CustomDrushStack
   *   DrushStack.
   */
  protected function getDrushStack($drush_path = "drush", $drupal_root_directory = "web") {

    /** @var \Lucacracco\Drupal8\Robo\Stack\CustomDrushStack $task_drush_stack */
    $task_drush_stack = $this->collectionBuilder()
      ->taskCustomDrushStack($drush_path);

    // Set Drupal web root directory.
    $task_drush_stack->drupalRootDirectory($drupal_root_directory);

    return $task_drush_stack;
  }

}
