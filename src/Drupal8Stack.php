<?php

namespace LucaCracco\Robo\Task\Drupal8;

use Exception;
use Robo\Common\Timer;
use Robo\Result;
use Robo\Task\StackBasedTask;

/**
 * Class Drupal8Stack.
 *
 * @package LucaCracco\Robo\Task\Drupal8
 *
 * @method getInfoSite()
 * @method setupInstallation()
 * @method install()
 * @method installFromConfig()
 * @method rebuildCache()
 * @method coreCron()
 * @method activeTheme()
 * @method clearFilesystem()
 * @method initFilesystem()
 * @method protectSite()
 * @method configureSettings()
 * @method importConfig()
 * @method importConfigPartial()
 * @method exportConfig()
 * @method backupDatabase()
 * @method importDatabase()
 * @method entityUpdates()
 * @method migrateGroup()
 * @method migrateStatus()
 * @method migrateRollback()
 * @method exec()
 */
class Drupal8Stack extends StackBasedTask {

  use Timer;

  /**
   * Drupal 8 Functionality.
   *
   * @var \LucaCracco\Robo\Task\Drupal8\Drupal8Functionality
   */
  protected $d8f;

  /**
   * Drupal8Stack constructor.
   *
   * @param string $environment
   *   Environment variable (local|stage|prod|custom1|..).
   * @param string $sub_dir
   *   Match to the sites that you want to start, useful for multi-site.
   *   In the case of a single installation to use/leave 'default'.
   *   Site (default|example1|..).
   * @param string $path_properties
   *   Absolute path where to find the configuration files.
   */
  public function __construct($environment = 'local', $sub_dir = 'default', $path_properties = 'build') {
    $this->d8f = new Drupal8Functionality($environment, $sub_dir, $path_properties);
    $this->stopOnFail(TRUE);
  }

  /**
   * {@inheritdoc}
   *
   * @return \LucaCracco\Robo\Task\Drupal8\Drupal8Functionality
   *   Drupal8 Functionality.
   */
  protected function getDelegate() {
    return $this->d8f;
  }

  /**
   * Run all of the queued objects on the stack.
   */
  public function run() {

    // Create result empty.
    $result = Result::success($this);

    // Start timer.
    $this->startTimer();

    // Exec task.
    foreach ($this->stack as $action) {
      $command = array_shift($action);
      $this->printTaskProgress($command, $action);
      // TODO: merge data from the result on this call
      // with data from the result on the previous call?
      // For now, the result always comes from the last function.
      $result = $this->callTaskMethod($command, $action);
      if ($this->stopOnFail && $result && !$result->wasSuccessful()) {
        break;
      }
    }

    // Stop timer.
    $this->stopTimer();

    // Recreate object result with execution time and message.
    if ($result->wasSuccessful()) {
      $message = "task complete.";
      return Result::success($this, $message, ['time' => $this->getExecutionTime()]);
    }

    // This return is used when found error in task execution.
    return $result;
  }

  /**
   * {@inheritdoc}
   */
  protected function printTaskProgress($command, $action) {

    try {
      $function_name = implode(" ", preg_split('/(?=[A-Z])/', $command[1]));
      $function_name = ucwords($function_name);
    }
    catch (Exception $e) {
      $function_name = $command[1];
    }

    $action = empty($action) ? '' : json_encode($action);
    $this->printTaskInfo("{$function_name} {$action}");
  }

}
