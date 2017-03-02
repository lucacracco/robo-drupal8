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
   * DrushStack used.
   *
   * @param string|null $drupal_site_uri
   *   Target a site.
   *
   * @return \Lucacracco\Drupal8\Robo\Stack\CustomDrushStack
   *   DrushStack with URI configured.
   */
  public function drushStack($drupal_site_uri = NULL) {

    // Init drush.
    $drush_stack = static::drushStackCache();
    if (!isset($drush_stack)) {
      $drush_stack = $this->getDrushStack(PathResolver::drush(), PathResolver::docroot());
    }

    // Override.
    if (isset($drupal_site_uri)) {
      $drush_stack->uri($drupal_site_uri);
    }
    else {
      if ($drush_stack->getUri() === NULL) {
        // Load from configurations.
        $drupal_site_uri_conf = Configurations::get('site_configuration.uri');
        if (isset($drupal_site_uri_conf)) {
          $drush_stack->uri($drupal_site_uri_conf);
        }
      }
    }

    // Save in cache.
    static::drushStackCache($drush_stack);

    return $drush_stack;
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

  /**
   * Cache DrushStack in global variable.
   *
   * @param \Lucacracco\Drupal8\Robo\Stack\CustomDrushStack $drush_stack
   *   The DrushStack.
   * @return \Lucacracco\Drupal8\Robo\Stack\CustomDrushStack|null
   *   The cached DrushStack.
   */
  protected static function drushStackCache($drush_stack = NULL) {
    $cid = '__ROBO_DRUSH_STACK__';

    if (isset($drush_stack) && !empty($drush_stack)) {
      $GLOBALS[$cid] = $drush_stack;
    }

    if (!isset($GLOBALS[$cid])) {
      return NULL;
    }

    return $GLOBALS[$cid];
  }

}
