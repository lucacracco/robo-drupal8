<?php

namespace Lucacracco\Drupal8\Robo\Task\Drush;

/**
 * Robo task: Import Drupal configuration.
 */
class ConfigImport extends ConfigExport {

  /**
   * Allows for partial config imports from the source directory.
   *
   * @var bool
   */
  protected $partial = FALSE;

  /**
   * Allows for partial config imports from the source directory.
   *
   * Only updates and new configs will be processed with this flag
   * (missing configs will not be deleted).
   *
   * @param bool $partial
   *   Default FALSE.
   */
  public function setPartial(bool $partial = FALSE) {
    $this->partial = $partial;
  }

  /**
   * {@inheritdoc}
   *
   * TODO: retrieve parent and change task!
   */
  public function run() {
    if (isset($this->skipModules)) {
      $this->drushStack()
        ->argForNextCommand("--skip-modules=" . $this->skipModules);
    }
    if ($this->partial) {
      $this->drushStack()
        ->argForNextCommand("--partial" . $this->partial);
    }
    $this->collection->add(
      $this->drushStack()
        ->drush('config-export')
    );
    return parent::run();
  }

}
