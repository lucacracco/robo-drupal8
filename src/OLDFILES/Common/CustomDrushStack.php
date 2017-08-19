<?php

namespace Lucacracco\Drupal8\Robo\Common;

use Lucacracco\Drupal8\Robo\Utility\PathResolver;

/**
 * Trait for load a Custom Drush Stack.
 *
 * @package Lucacracco\Drupal8\Robo\Common
 */
trait CustomDrushStack {

  /**
   * DrushStack used.
   *
   * @param null|string $drupal_site_uri
   *   Target a site.
   * @param null|string $drush_path
   *   Drush path used.
   * @param null|string $drupal_root_directory
   *   Drupal web root directory.
   *
   * @return \Lucacracco\Drupal8\Robo\Stack\CustomDrushStack
   *   DrushStack with URI configured.
   */
  protected function drushStack($drupal_site_uri = NULL, $drush_path = NULL, $drupal_root_directory = NULL) {

    $drush_path = isset($drush_path) ? $drush_path : PathResolver::drushPath();
    $drupal_root_directory = isset($drupal_root_directory) ? $drupal_root_directory : PathResolver::docroot();
    $drupal_site_uri = isset($drupal_site_uri) ? $drupal_site_uri : \Robo\Robo::config()
      ->get('drupal.site.uri', 'default');

    // Init drushPath.
    $drushStack = $this->getDrushStack($drush_path, $drupal_root_directory);

    // Set uri.
    $drushStack->uri($drupal_site_uri);

    return $drushStack;
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
  protected function getDrushStack($drush_path = "drushPath", $drupal_root_directory = "web") {

    /** @var \Lucacracco\Drupal8\Robo\Stack\CustomDrushStack $task_drush_stack */
    $task_drush_stack = $this->collectionBuilder()
      ->taskCustomDrushStack($drush_path);

    // Set Drupal web root directory.
    $task_drush_stack->drupalRootDirectory($drupal_root_directory);

    return $task_drush_stack;
  }

}
