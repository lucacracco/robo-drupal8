<?php

namespace Lucacracco\Drupal8\Robo\Task\DatabaseDump;

use Lucacracco\Drupal8\Robo\Common\CustomDrushStack;
use Robo\Collection\Collection;
use Robo\Common\BuilderAwareTrait;
use Robo\Common\TaskIO;
use Robo\Common\Timer;
use Robo\Contract\BuilderAwareInterface;
use Robo\Result;
use Robo\Task\BaseTask;

/**
 * Robo task base: Database dump with drush.
 */
class Dump extends BaseTask implements BuilderAwareInterface {

  use BuilderAwareTrait;
  use TaskIO;
  use Timer;
  use CustomDrushStack;

  /**
   * Collection Builder.
   *
   * @var \Robo\Collection\Collection
   */
  protected $collection;

  /**
   * Dump file path.
   *
   * @var string
   */
  protected $filePath;

  /**
   * Constructor.
   *
   * @param string $filepath
   *   The dump file path.
   */
  public function __construct($filepath) {
    $this->filePath = $filepath;
    $this->collection = new Collection();
  }

  /**
   * Export database.
   */
  public function export() {
    $this->collection->add(
      $this->drushStack()
        ->argForNextCommand(' > ' . escapeshellarg($this->filePath))
        ->argForNextCommand('ordered-dump')
        ->argForNextCommand('extra=--skip-comments')
        ->argForNextCommand('structure-tables-list=' . escapeshellarg(implode(',', $this->getStructureOnlyTableList())))
        ->drush('sql-dump')
    );
    return $this;
  }


  /**
   * {@inheritdoc}
   */
  public function run() {
    $this->printTaskInfo($this->getPrintedTaskName());
    $this->startTimer();
    $return = $this->collection->run();
    $this->stopTimer();
    return new Result($this, $return->getExitCode(), $return->getOutputData(), ['time' => $this->getExecutionTime()]);
  }

  /**
   * Import Database.
   *
   * Not drop tables exist.
   */
  public function import() {
    $this->collection->add(
      $this->drushStack()
        ->argForNextCommand('< ' . escapeshellarg($this->filePath))
        ->drush('sql-cli')
    );
    return $this;
  }

  /**
   * Return structure-only database table names.
   *
   * This is used to make the exported file as small as possible. All returned
   * database table names indicate to only export their structure but not data
   * rows.
   *
   * @return array
   *   An array of database table names.
   */
  protected function getStructureOnlyTableList() {
    $tables = [
      'cache_data',
      'cache_bootstrap',
      'cache_container',
      'cache_config',
      'cache_default',
      'cache_discovery',
      'cache_dynamic_page_cache',
      'cache_entity',
      'cache_menu',
      'cache_migrate',
      'cache_render',
      'cache_toolbar',
      'cachetags',
      'watchdog',
      'sessions',
    ];

    return $tables;
  }


}
