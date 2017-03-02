<?php

namespace Lucacracco\Drupal8\Robo\Task\Site;

use Lucacracco\Drupal8\Robo\Task\Drush\CacheRebuild;
use Lucacracco\Drupal8\Robo\Task\Drush\DrushTask;
use Lucacracco\Drupal8\Robo\Task\Settings\EnsureSettingsFile;
use Lucacracco\Drupal8\Robo\Utility\Drupal;
use Lucacracco\Drupal8\Robo\Utility\DrupalCoreStatus;
use Lucacracco\Drupal8\Robo\Utility\Environment;
use Lucacracco\Drupal8\Robo\Utility\PathResolver;
use Robo\Collection\Collection;
use Robo\Common\BuilderAwareTrait;
use Robo\Contract\BuilderAwareInterface;
use Robo\Task\BaseTask;
use Robo\Task\Composer\Install as ComposerInstall;
use Robo\TaskAccessor;

/**
 * Robo task base: Status site.
 */
class Status extends SiteTask {

  /**
   * Function to check configuration.
   *
   * TODO: implement controll.
   *
   * @return bool
   */
  protected function configurationValid() {
    return TRUE;
  }

  /**
   * {@inheritdoc}
   */
  public function run() {
    return $this->collectionBuilder()->taskDrushStatus()->run();
  }

}
