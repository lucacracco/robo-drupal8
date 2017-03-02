<?php

namespace Lucacracco\Drupal8\Robo\Task\Site;

use Lucacracco\Drupal8\Robo\Utility\Configurations;
use Lucacracco\Drupal8\Robo\Utility\Environment;
use Lucacracco\Drupal8\Robo\Utility\PathResolver;

/**
 * Robo task base: Initialize site.
 */
class Initialize extends SiteTask {

  /**
   * Need build project.
   *
   * @var boolean
   */
  protected $needsBuild;

  /**
   * Initialize constructor.
   *
   * @param bool $needs_build
   */
  public function __construct($needs_build = NULL) {
    parent::__construct();
    if (isset($needs_build)) {
      $this->needsBuild = $needs_build;
    }
    else {
      $this->needsBuild = Environment::get();
    }
  }

  /**
   * @return bool
   */
  public function isNeedsBuild(): bool {
    return $this->needsBuild;
  }

  /**
   * @param bool $needsBuild
   */
  public function setNeedsBuild(bool $needsBuild) {
    $this->needsBuild = $needsBuild;
  }

  /**
   * Skip?
   *
   * @return bool
   */
  protected function skip() {
    return !$this->needsBuild;
  }

  /**
   * Return task collection for check and install composer.
   *
   * @param string $dir
   *
   * @return \Robo\Collection\Collection
   *   The task collection.
   */
  public function composerInstall($dir) {
    if ($this->skip()) {
      return $this->collection;
    }

    $this->collection->add(
    // Run 'composer install'.
      $this->collectionBuilder()
        ->taskComposerInstall()
        ->dir($dir)
        ->option('optimize-autoloader')
        ->option('prefer-dist')
    );

    return $this->collection;
  }

}
