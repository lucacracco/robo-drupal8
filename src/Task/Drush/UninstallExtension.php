<?php

namespace Lucacracco\Drupal8\Robo\Task\Drush;

/**
 * Robo task: Uninstall extension.
 */
class UninstallExtension extends EnableExtension {

  /**
   * {@inheritdoc}
   */
  protected $command = "pm-uninstall";

}
