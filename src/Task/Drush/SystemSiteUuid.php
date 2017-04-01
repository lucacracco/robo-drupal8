<?php

namespace Lucacracco\Drupal8\Robo\Task\Drush;

class SystemSiteUuid extends DrushTask {

  /**
   * SystemSiteUuid.
   *
   * @var string
   */
  protected $systemSiteUuid;

  /**
   * Constructor.
   *
   * @param string $uuid
   *   System Site Uuid.
   */
  public function __construct($uuid = NULL) {
    parent::__construct();
    $this->systemSiteUuid = $uuid;
  }


  /**
   * {@inheritdoc}
   */
  public function run() {

    $this->printTaskInfo('Update SystemSiteUuid');

    if (!isset($this->systemSiteUuid)) {
      $this->systemSiteUuid = $this->drushStack()
        ->drush('config-get "system.site" uuid')
        ->run();
    }

    // TODO: more control?
    if (!is_string($this->systemSiteUuid)) {
      throw new \Exception("UUID not correct.");
    }

    $this->collection->add(
      $this->drushStack()
        ->argForNextCommand(escapeshellarg($this->systemSiteUuid))
        ->drush('config-set "system.site" uuid')
    );
    return parent::run();
  }

}
