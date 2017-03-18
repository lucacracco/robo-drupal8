<?php

namespace Lucacracco\Drupal8\Robo\Task\Site;

use Lucacracco\Drupal8\Robo\Utility\Environment;
use Lucacracco\Drupal8\Robo\Utility\PathResolver;

/**
 * Robo task base: Initialize site.
 */
class Initialize extends SiteTask {

  /**
   * Directory.
   *
   * @var string
   */
  protected $dir;

  /**
   * Need build project.
   *
   * @var boolean
   */
  protected $needsBuild = FALSE;

  /**
   * Initialize constructor.
   */
  public function __construct() {
    parent::__construct();
    $this->dir = PathResolver::docroot();
    $this->needsBuild = Environment::getEnvironment();
  }

  /**
   * @return bool
   */
  public function isNeedsBuild(): bool {
    return $this->needsBuild;
  }

  /**
   * Set need build.
   *
   * @param bool $needsBuild
   *
   * @return $this
   */
  public function setNeedsBuild(bool $needsBuild = TRUE) {
    $this->needsBuild = $needsBuild;
    return $this;
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
   * @param string|null $dir
   *
   * @return $this
   */
  public function composerInstall($dir = NULL) {
    if ($this->skip()) {
      return $this;
    }

    $this->collection->add(
    // Run 'composer install'.
      $this->collectionBuilder()
        ->taskComposerInstall()
        ->dir($dir)
        ->option('optimize-autoloader')
        ->option('prefer-dist')
    );

    return $this;
  }

}
