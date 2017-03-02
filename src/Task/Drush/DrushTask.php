<?php

namespace Lucacracco\Drupal8\Robo\Task\Drush;

use Lucacracco\Drupal8\Robo\Common\CustomDrushStack;
use Robo\Collection\Collection;
use Robo\Common\BuilderAwareTrait;
use Robo\Contract\BuilderAwareInterface;
use Robo\Result;
use Robo\Task\BaseTask;

/**
 * Robo task base: Drush.
 */
abstract class DrushTask extends BaseTask implements BuilderAwareInterface {

  use BuilderAwareTrait;
  use CustomDrushStack;

  /**
   * Collection Builder.
   *
   * @var \Robo\Collection\Collection
   */
  protected $collection;
  /**
   * Custom Drush stack.
   *
   * @var \Lucacracco\Drupal8\Robo\Stack\CustomDrushStack
   */
  protected $drushStack = NULL;

  /**
   * DrushTask constructor.
   *
   * @param null|string $uri
   *   Target site
   */
  public function __construct($uri = NULL) {
    $this->collection = new Collection();
    if (isset($uri)) {
      $this->uri($uri);
    }
  }

  /**
   * Set custom uri for multisite.
   *
   * @param string $uri
   *   Target a site.
   */
  public function uri($uri) {
    $this->drushStack($uri);
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

}
