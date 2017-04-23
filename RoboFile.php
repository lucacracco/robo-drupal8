<?php

/**
 * This is project's console commands configuration for Robo task runner.
 *
 * @see http://robo.li/
 */
class RoboFile extends \Robo\Tasks {

  use \Lucacracco\Drupal8\Robo\Common\Drupal;
  use \Lucacracco\Drupal8\Robo\Stack\loadTasks;
  use \Lucacracco\Drupal8\Robo\Task\Drush\loadTasks;
  use \Lucacracco\Drupal8\Robo\Task\Site\loadTasks;

  protected $pathsConf = ['_base.yml.dist'];

  /**
   * RoboFile constructor.
   */
  public function __construct() {

    $this->stopOnFail(TRUE);

    // Create object configuration empty.
    $config = \Robo\Robo::config();
    $config->setProgressBarAutoDisplayInterval(180);

    // Load Configurations from yml file.
    foreach($this->pathsConf as $path) {
      if (!file_exists($path)) {
        throw new \InvalidArgumentException("File '_base.yml.dist' configuration not found.");
      }
    }
    \Robo\Robo::loadConfiguration($this->pathsConf, $config);

    // Import new configuration in global configurations.
    \Robo\Robo::config()->import($config->export());
  }

  /**
   * Start.
   */
  public function start() {

    // TODO: create collection task for install Drupal8.

    $collection = new \Robo\Collection\Collection();
    $task_list = [
      'buildNew' => $this->taskSiteBuildNew()
    ];
    $collection->addTaskList($task_list);
    return $collection;
  }

  /**
   * Finish.
   */
  public function finish() {

    // TODO: create colelction task for export, rebuild cache and test site Drupal8 installed.
  }

}
