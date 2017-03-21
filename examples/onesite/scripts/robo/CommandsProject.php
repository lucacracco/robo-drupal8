<?php

namespace Project\Robo;

use Consolidation\AnnotatedCommand\Events\CustomEventAwareInterface;
use Consolidation\AnnotatedCommand\Events\CustomEventAwareTrait;
use Lucacracco\Drupal8\Robo\Utility\Configurations;
use Lucacracco\Drupal8\Robo\Utility\PathResolver;
use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerAwareTrait;

/**
 * This is project's console commands configuration for Robo task runner.
 *
 * @see http://robo.li/
 */
class CommandsProject extends \Robo\Tasks implements LoggerAwareInterface, CustomEventAwareInterface {

  use LoggerAwareTrait;
  use CustomEventAwareTrait;

  /**
   * Constructor.
   */
  public function __construct() {

    // Initialize path base.
    PathResolver::init('.');

    \Lucacracco\Drupal8\Robo\Utility\Environment::setEnvironment('pippo');
    \Lucacracco\Drupal8\Robo\Utility\Environment::setNeedBuild(TRUE);

    // Configurations override.
    $configuration_overrides = [
      'site_configuration.name' => 'Pippo',
    ];

    // Initialize configurations for Drupal8 project.
    Configurations::init(
      [
        PathResolver::root() . '/build/_default.yml.dist',
        '?' . PathResolver::root() . '/build/default.yml',
      ],
      $configuration_overrides
    );
  }

  /**
   * @hook command-event build:new
   */
  public function hookEventBuildNew() {
    $this->io()->section("Build New site.");
  }

  /**
   * @hook post-command build:new
   */
  public function hookPostBuildNew() {
    $this->io()->section("Complete install");
  }

}