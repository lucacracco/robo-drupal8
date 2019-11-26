<?php

namespace Lucacracco\RoboDrupal8\Robo\Config;

use Consolidation\Config\Loader\YamlConfigLoader;
use Robo\Common\IO;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\ConsoleOutput;

/**
 * Class ConfigInitializer.
 *
 * @package Lucacracco\RoboDrupal8\Robo\Config
 */
class ConfigInitializer {

  use IO;

  /**
   * @var \Lucacracco\RoboDrupal8\Robo\Config\DefaultConfig
   */
  protected $config;

  /**
   * @var \Symfony\Component\Console\Input\InputInterface
   */
  protected $input;

  /**
   * @var \Consolidation\Config\Loader\YamlConfigLoader
   */
  protected $loader;

  /**
   * @var \Symfony\Component\Console\Output\ConsoleOutput
   */
  protected $output;

  /**
   * @var \Lucacracco\RoboDrupal8\Robo\Config\YamlConfigProcessor
   */
  protected $processor;

  /**
   * @var string
   */
  protected $site;

  /**
   * ConfigInitializer constructor.
   *
   * @param string $repo_root
   * @param \Symfony\Component\Console\Input\InputInterface $input
   * @param \Symfony\Component\Console\Output\ConsoleOutput $output
   *
   * @throws \Exception
   */
  public function __construct($repo_root, InputInterface $input, ConsoleOutput $output) {
    $this->input = $input;
    $this->output = $output;
    $this->config = new DefaultConfig($repo_root);
    $this->loader = new YamlConfigLoader();
    $this->processor = new YamlConfigProcessor();
  }

  /**
   * Initialize.
   *
   * @return \Lucacracco\RoboDrupal8\Robo\Config\DefaultConfig
   */
  public function initialize() {
    if (!$this->site) {
      $site = $this->determineSite();
      $this->setSite($site);
    }
    $this->determineEnvironment();
    $this->loadConfigFiles();
    $this->processConfigFiles();

    // Print debug information.
    $this->io()
      ->note("Site \"{$this->site}\"; Environment: \"{$this->environment}\"");

    return $this->config;
  }

  /**
   * @param mixed $site
   */
  public function setSite($site) {
    $this->site = $site;
    $this->config->setSite($site);
  }

  /**
   * Load default config, project, site and environment.
   *
   * @return $this
   */
  public function loadConfigFiles() {
    $this->loadDefaultConfig();
    $this->loadProjectConfig();
    $this->loadSiteConfig();
    return $this;
  }

  /**
   * Load default configuration from RoboDrupal8.
   *
   * @return $this
   */
  public function loadDefaultConfig() {
    $this->processor->add($this->config->export());
    return $this;
  }

  /**
   * Load project configurations.
   *
   * @return $this
   */
  public function loadProjectConfig() {
    $this->processor->extend($this->loader->load("{$this->config->get('rd8.dir')}/rd8.project.yml"));
    $this->processor->extend($this->loader->load("{$this->config->get('rd8.dir')}/rd8.project.{$this->environment}.yml"));
    return $this;
  }

  /**
   * Load site configurations.
   *
   * @return $this
   */
  public function loadSiteConfig() {
    if ($this->site) {
      $possible_configuration_files = [
        // Load from build directory.
        $this->config->get('rd8.dir') . DIRECTORY_SEPARATOR . "rd8.{$this->site}.yml",
        $this->config->get('rd8.dir') . DIRECTORY_SEPARATOR . "rd8.{$this->site}.{$this->environment}.yml",
      ];
      $found_config_site = FALSE;
      foreach ($possible_configuration_files as $path) {
        if (file_exists($path)) {
          $this->processor->extend($this->loader->load($path));
          $found_config_site = TRUE;
        }
      }

      if (!$found_config_site) {
        $this->io()
          ->warning("Not found a configuration for site \"{$this->site}\". Please use option \"--site=[SITE]\".");
      }
    }
    return $this;
  }

  /**
   * @return $this
   */
  public function determineEnvironment() {
    // Support --environment=ci.
    if ($this->input->hasParameterOption('--environment')) {
      $environment = $this->input->getParameterOption('--environment');
    }
    // Support --define environment=ci.
    elseif ($this->input->hasParameterOption('environment')) {
      $environment = ltrim($this->input->getParameterOption('environment'), '=');
    }
    // Support RD8_ENV=ci.
    elseif (getenv("RD8_ENV")) {
      $environment = getenv("RD8_ENV");
    }
    else {
      $environment = 'local';
    }

    $this->environment = $environment;
    $this->config->set('environment', $environment);

    return $this;
  }

  /**
   * Process configuration files.
   *
   * @return $this
   */
  public function processConfigFiles() {
    $this->config->replace($this->processor->export());
    $this->config->populateHelperConfig();
    return $this;
  }

  /**
   * Return the site target.
   *
   * @return mixed|string
   */
  protected function determineSite() {
    $site = 'default';
    if ($this->input->hasParameterOption('site')) {
      $site = $this->input->getParameterOption('site');
    }
    elseif ($this->input->hasParameterOption('--site')) {
      $site = $this->input->getParameterOption('--site');
    }
    elseif ($this->input->hasParameterOption('-s')) {
      $site = ltrim($this->input->getParameterOption('-s'), '=');
    }
    return $site;
  }

}
