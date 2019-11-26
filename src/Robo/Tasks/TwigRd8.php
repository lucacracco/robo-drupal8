<?php

namespace Lucacracco\RoboDrupal8\Robo\Tasks;

use Heydon\Robo\Task\Twig;
use Robo\Common\TaskIO;
use Robo\Exception\TaskException;
use Robo\Exception\TaskExitException;
use Robo\Task\BaseTask;
use Twig_Environment;
use Twig_Extension;
use Twig_Loader_Array;
use Twig_Loader_Filesystem;

/**
 * Class TwigRd8.
 *
 * @package Lucacracco\RoboDrupal8\Robo\Tasks
 */
class TwigRd8 extends Twig {

  /**
   * @param string $templates_dir
   *
   * @return $this
   * @throws \Robo\Exception\TaskException
   */
  public function addTemplatesDirectory($templates_dir) {
    $this->templatesDirectory[] = $templates_dir;
  }

}
