<?php

/**
 * This is project's console commands configuration for Robo task runner.
 *
 * @see http://robo.li/
 */
class RoboFile extends \Robo\Tasks {

  use \Lucacracco\Drupal8\Robo\Common\Drupal;
  use \Lucacracco\Drupal8\Robo\Stack\loadTasks;
  use \Lucacracco\Drupal8\Robo\Task\loadTasks;

  /**
   * Paths Configurations.
   *
   * @var string[]
   */
  protected $pathsConf = ['./build/_base.yml.dist'];

  /**
   * RoboFile constructor.
   */
  public function __construct() {

    $this->stopOnFail(TRUE);

    // Create object configuration empty.
    $config = \Robo\Robo::config();
    // TODO: not work?!
    $config->setProgressBarAutoDisplayInterval(99999);

    /**
     * TODO: remove and use \Robo\Robo::loadConfiguration($this->pathsConf, $config);
     * when correct the bug in this function.
     * Default use '$config->import($loader->export());' and not
     * '$config->import($processor->export());'.
     */
    $loader = new \Consolidation\Config\Loader\YamlConfigLoader();
    $processor = new \Consolidation\Config\Loader\ConfigProcessor();
    $processor->add($config->export());
    foreach ($this->pathsConf as $path) {
      if (file_exists($path)) {
        $processor->extend($loader->load($path));
      }
    }
    $config->import($processor->export());

    // Import new configuration in global configurations.
    \Robo\Robo::config()->import($config->export());
  }

  /**
   * Start: build a new site.
   */
  public function start() {
    $collection = new \Robo\Collection\Collection();
    $task_list = [
      'buildNew' => $this->taskDrupalInstallTasks()->buildNew(),
    ];
    $collection->addTaskList($task_list);
    return $collection;
  }

  /**
   * Finish: export configuration and print one-time login.
   */
  public function finish() {
    $collection = new \Robo\Collection\Collection();
    $task_list = [
      'exportConfigurations' => $this->taskDrupalConfigurationsTasks()
        ->configurationExport(),
      'loginOneTimeUrl' => $this->taskDrupalMaintenanceTasks()
        ->loginOneTimeUrl(1),
    ];
    $collection->addTaskList($task_list);
    return $collection;
  }

}
