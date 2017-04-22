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

  /**
   * @var \Robo\Config\Config
   */
  protected $config;

  /**
   * RoboFile constructor.
   */
  public function __construct() {

    // Load Configurations.
    $this->config = new \Robo\Config\Config();
    $loader = new \Robo\Config\YamlConfigLoader();
    $processor = new \Robo\Config\ConfigProcessor();
    $processor->add($this->config->export());
    $processor->extend($loader->load('_base.yml.dist'));
    $this->config->import($processor->export());
  }

  /**
   * Start.
   */
  public function start() {

    // TODO: create collection task for install Drupal8.
  }

  /**
   * Finish.
   */
  public function finish() {

    // TODO: create colelction task for export, rebuild cache and test site Drupal8 installed.
  }

}
