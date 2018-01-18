<?php

namespace Lucacracco\RoboDrupal8\Robo\Config;

use Consolidation\Config\Loader\YamlConfigLoader;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\ConsoleOutput;

/**
 * Class ConfigInitializer.
 *
 * @package Lucacracco\RoboDrupal8\Robo\Config
 */
class ConfigInitializer {

  /**
   * @var \Lucacracco\RoboDrupal8\Robo\Config\DefaultConfig
   */
  protected $config;

  /**
   * @var \Symfony\Component\Console\Input\InputInterface
   */
  protected $input;

  /**
   * @var \Symfony\Component\Console\Output\ConsoleOutput
   */
  protected $output;

  /**
   * @var \Consolidation\Config\Loader\YamlConfigLoader
   */
  protected $loader;

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
      $site = $this->getDefaultSite();
      $this->setSite($site);
    }
    $this->loadConfigFiles();
    $this->processConfigFiles();

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
    $this->loadEnvironmentConfig();

    return $this;
  }

  /**
   * @return $this
   */
  public function loadDefaultConfig() {
    $this->processor->add($this->config->export());
    return $this;
  }

  /**
   * @return $this
   */
  public function loadProjectConfig() {
    $this->processor->extend($this->loader->load($this->config->get('repo.root') . '/robo-drupal8/_project.yml'));
    return $this;
  }

  /**
   *
   * @return $this
   */
  public function loadSiteConfig() {
    if ($this->site) {
      $this->processor->extend($this->loader->load($this->config->get('repo.root') . '/robo-drupal8/sites/' . $this->site . '.yml'));
      $this->processor->extend($this->loader->load($this->config->get('docroot') . '/sites/' . $this->site . '/' . $this->site . '.yml'));
    }
    return $this;
  }

  /**
   * @return $this
   */
  public function loadEnvironmentConfig() {

    if (!$this->input->hasParameterOption('environment')) {
      return $this;
    }

    // Default environment configuration.
    $environment = $this->input->hasParameterOption('environment');
    $this->processor->extend($this->loader->load($this->config->get('repo.root') . '/robo-drupal8/' . $environment . '.yml'));

    // Custom environment configuration based to site.
    if ($this->site) {
      $this->processor->extend($this->loader->load($this->config->get('repo.root') . '/robo-drupal8/sites/' . $this->site . '.' . $environment . '.yml'));
      $this->processor->extend($this->loader->load($this->config->get('docroot') . '/sites/' . $this->site . '/' . $this->site . '.' . $environment . '.yml'));
    }
    return $this;
  }

  /**
   * @return $this
   */
  public function processConfigFiles() {
    $this->config->import($this->processor->export());
    $this->config->populateHelperConfig();
    return $this;
  }

  /**
   * @return mixed|string
   */
  protected function getDefaultSite() {
    if ($this->input->hasParameterOption('site')) {
      $site = $this->input->getParameterOption('site');
      $this->output->writeln("<comment>Target Site: $site.</comment>");
    }
    else {
      $site = 'default';
    }
    return $site;
  }

}