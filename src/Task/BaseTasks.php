<?php

namespace Lucacracco\Drupal8\Robo\Task;

use Lucacracco\Drupal8\Robo\Utility\PathResolver;
use Robo\Collection\Collection;
use Robo\Common\BuilderAwareTrait;
use Robo\Config\Config;
use Robo\Contract\BuilderAwareInterface;
use Robo\Result;
use Robo\Task\BaseTask;

/**
 * Class BaseTasks.
 *
 * @package Lucacracco\Drupal8\Robo\Task
 */
abstract class BaseTasks extends BaseTask implements BuilderAwareInterface {

  use BuilderAwareTrait;
  use \Lucacracco\Drupal8\Robo\Common\CustomDrushStack;

  /**
   * Collection Builder.
   *
   * @var \Robo\Collection\Collection
   */
  protected $collection;

  /**
   * Drupal root.
   *
   * @var string
   */
  protected $drupalRoot;

  /**
   * Root Project.
   *
   * @var string
   */
  protected $root;

  /**
   * Directory site.
   *
   * @var string
   */
  protected $siteDir;

  /**
   * SiteTask constructor.
   *
   * @param \Robo\Config\Config|NULL $config
   *  If null load \Robo\Robo::config().
   */
  public function __construct(Config $config = NULL) {
    $this->config = isset($config) ? $config : \Robo\Robo::config();
    $this->collection = new Collection();

    // Configuration validation.
    if (!$this->configurationValid()) {
      throw new \InvalidArgumentException(get_class($this) . ' - Configurations not valid');
    }

    $this->root = PathResolver::absolute($this->config->get('project.base_path', '/var/www/html'));
    $this->drupalRoot = PathResolver::absolute($this->config->get('drupal.root', './web'));
    $this->siteDir = PathResolver::absolute($this->drupalRoot . DIRECTORY_SEPARATOR . 'sites' . DIRECTORY_SEPARATOR . $this->config->get('drupal.site.sub_dir', 'default'));
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
   * Function to check configuration.
   *
   * @return bool
   */
  protected function configurationValid() {
    return TRUE;
  }

}
