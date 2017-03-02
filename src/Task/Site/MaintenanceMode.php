<?php

namespace Lucacracco\Drupal8\Robo\Task\Site;

/**
 * Robo task base: Enable/disable maintenance mode.
 */
class MaintenanceMode extends SiteTask {

  /**
   * Status.
   *
   * @var bool
   */
  protected $status;

  /**
   * Constructor.
   *
   * @param bool $status
   *   Whether to enable/disable maintenance mode.
   */
  public function __construct($status) {
    parent::__construct();
    $this->status = $status;
  }

  /**
   * {@inheritdoc}
   */
  public function run() {
    return $this->collectionBuilder()
      ->taskDrushStateSet('system.maintenance_mode', $this->status ? 1 : 0, 'integer')
      ->run();
  }

}
