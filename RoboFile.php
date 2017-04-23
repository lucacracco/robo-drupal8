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

  protected $pathsConf = ['_base.yml.dist'];

  /**
   * RoboFile constructor.
   */
  public function __construct() {

    $this->stopOnFail(TRUE);

    // Create object configuration empty.
    $config = \Robo\Robo::config();
    $config->setProgressBarAutoDisplayInterval(180);

    /**
     * TODO: remove and use \Robo\Robo::loadConfiguration($this->pathsConf, $config);
     * when correct the bug in this function.
     * Default use '$config->import($loader->export());' and not
     * '$config->import($processor->export());'.
     */
    $loader = new \Robo\Config\YamlConfigLoader();
    $processor = new \Robo\Config\ConfigProcessor();
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
   * Start.
   */
  public function start() {

    // TODO: create collection task for install Drupal8.

    $collection = new \Robo\Collection\Collection();
    $task_list = [
      'buildNew' => $this->taskInstallTasks()->buildNew(),
    ];
    $collection->addTaskList($task_list);
    return $collection;
  }

  /**
   * Finish.
   */
  public function finish() {

    // TODO: create colelction task for export, rebuild cache and test site Drupal8 installed.
    $collection = new \Robo\Collection\Collection();
    $task_list = [
      'exportConfigurations' => $this->taskConfigurationsTasks()
        ->configurationExport(),
    ];
    $collection->addTaskList($task_list);
    return $collection;
  }

}
