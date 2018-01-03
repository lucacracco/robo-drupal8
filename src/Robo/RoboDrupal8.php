<?php

namespace Lucacracco\RoboDrupal8\Robo;

use Consolidation\AnnotatedCommand\CommandFileDiscovery;
use League\Container\ContainerAwareInterface;
use League\Container\ContainerAwareTrait;
use Lucacracco\RoboDrupal8\Robo\Common\Executor;
use Lucacracco\RoboDrupal8\Robo\Config\ConfigAwareTrait;
use Lucacracco\RoboDrupal8\Robo\Inspector\Inspector;
use Lucacracco\RoboDrupal8\Robo\Inspector\InspectorAwareInterface;
use Lucacracco\RoboDrupal8\Robo\Log\Rd8LogStyle;
use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerAwareTrait;
use Robo\Collection\CollectionBuilder;
use Robo\Config\Config;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Robo\Robo;
use Robo\Runner as RoboRunner;

/**
 * The RoboDrupal8 Robo application.
 *
 * @package Lucacracco\RoboDrupal8\Robo
 */
class RoboDrupal8 implements ContainerAwareInterface, LoggerAwareInterface {

  const VERSION = '2.x';

  use ConfigAwareTrait;
  use ContainerAwareTrait;
  use LoggerAwareTrait;

  /**
   * The Robo task runner.
   *
   * @var \Robo\Runner
   */
  private $runner;

  /**
   * An array of Robo commands available to the application.
   *
   * @var string[]
   */
  private $commands = [];

  /**
   * Object constructor.
   *
   * @param \Robo\Config\Config $config
   *   The RD8 configuration.
   * @param \Symfony\Component\Console\Input\InputInterface $input
   *   The input.
   * @param \Symfony\Component\Console\Output\OutputInterface $output
   *   The output.
   */
  public function __construct(Config $config, InputInterface $input = NULL, OutputInterface $output = NULL) {
    $this->setConfig($config);
    $application = new Application('RoboDrupal8', RoboDrupal8::VERSION);

    $container = Robo::createDefaultContainer($input, $output, $application, $config);
    $this->setContainer($container);
    $this->addDefaultArgumentsAndOptions($application);
    $this->configureContainer($container);
    $this->addBuiltInCommandsAndHooks();
    $this->addPluginsCommandsAndHooks();

    $this->runner = new RoboRunner();
    $this->runner->setContainer($container);

    $this->setLogger($container->get('logger'));
  }

  /**
   * Register the necessary classes for RD8.
   */
  public function configureContainer($container) {

    $container->share('logStyler', Rd8LogStyle::class);

    // We create our own builder so that non-command classes are able to
    // implement task methods, like taskExec(). Yes, there are now two builders
    // in the container. "collectionBuilder" used for the actual command that
    // was executed, and "builder" to be used with non-command classes.
    $rd8_tasks = new RoboDrupal8Tasks();
    $builder = new CollectionBuilder($rd8_tasks);
    $rd8_tasks->setBuilder($builder);
    $container->add('builder', $builder);
    $container->add('executor', Executor::class)
      ->withArgument('builder');

    $container->share('inspector', Inspector::class)
      ->withArgument('executor');

    $container->inflector(InspectorAwareInterface::class)
      ->invokeMethod('setInspector', ['inspector']);

    /** @var \Consolidation\AnnotatedCommand\AnnotatedCommandFactory $factory */
    $factory = $container->get('commandFactory');
    // Tell the command loader to only allow command functions that have a
    // name/alias.
    $factory->setIncludeAllPublicMethods(FALSE);
  }

  /**
   * Runs the instantiated RD8 application.
   *
   * @param \Symfony\Component\Console\Input\InputInterface $input
   *   An input object to run the application with.
   * @param \Symfony\Component\Console\Output\OutputInterface $output
   *   An output object to run the application with.
   *
   * @return int
   *   The exiting status code of the application
   *
   * @throws \Psr\Container\ContainerExceptionInterface
   * @throws \Psr\Container\NotFoundExceptionInterface
   */
  public function run(InputInterface $input, OutputInterface $output) {
    $application = $this->getContainer()->get('application');
    $status_code = $this->runner->run($input, $output, $application, $this->commands);
    return $status_code;
  }

  /**
   * Add the commands and hooks which are shipped with core RD8.
   */
  private function addBuiltInCommandsAndHooks() {
    $commands = $this->getCommands([
      'path' => __DIR__ . '/Commands',
      'namespace' => 'Lucacracco\RoboDrupal8\Robo\Commands',
    ]);
    $hooks = $this->getHooks([
      'path' => __DIR__ . '/Hooks',
      'namespace' => 'Lucacracco\RoboDrupal8\Robo\Hooks',
    ]);
    $this->commands = array_merge($commands, $hooks);
  }

  /**
   * Registers custom commands and hooks defined project.
   */
  private function addPluginsCommandsAndHooks() {
    $commands = $this->getCommands([
      'path' => $this->getConfig()
          ->get('repo.root') . '/robo-drupal8/src/Commands',
      'namespace' => 'Lucacracco\RoboDrupal8\Custom\Commands',
    ]);
    $hooks = $this->getHooks([
      'path' => $this->getConfig()
          ->get('repo.root') . '/robo-drupal8/src/Hooks',
      'namespace' => 'Lucacracco\RoboDrupal8\Custom\Hooks',
    ]);
    $plugin_commands_hooks = array_merge($commands, $hooks);
    $this->commands = array_merge($this->commands, $plugin_commands_hooks);
  }

  /**
   * Add any global arguments or options that apply to all commands.
   *
   * @param \Lucacracco\RoboDrupal8\Robo\Application|\Symfony\Component\Console\Application $app
   *   The Symfony application.
   */
  private function addDefaultArgumentsAndOptions(Application $app) {
    $app->getDefinition()->addOption(
      new InputOption('--yes', '-y', InputOption::VALUE_NONE, 'Answer all confirmations with "yes"')
    );
    $app->getDefinition()->addOption(
      new InputOption('--define', '-D', InputOption::VALUE_REQUIRED | InputOption::VALUE_IS_ARRAY, 'Define a configuration item value.', [])
    );
    $app->getDefinition()->addOption(
      new InputOption('--site', '-s', InputOption::VALUE_OPTIONAL, 'URI of the drupal site to use (only needed in multisite environments).', 'default')
    );
  }

  /**
   * Discovers command classes using CommandFileDiscovery.
   *
   * @param string[] $options
   *   Elements as follow
   *    string path      The full path to the directory to search for commands
   *    string namespace The full namespace for the command directory.
   *
   * @return array
   *   An array of Command classes
   */
  private function getCommands(array $options = [
    'path' => NULL,
    'namespace' => NULL,
  ]) {
    $discovery = new CommandFileDiscovery();
    $discovery
      ->setSearchPattern('*Command.php')
      ->setSearchLocations([])
      ->addExclude('Internal');
    return $discovery->discover($options['path'], $options['namespace']);
  }

  /**
   * Discovers hooks using CommandFileDiscovery.
   *
   * @param string[] $options
   *   Elements as follow
   *    string path      The full path to the directory to search for commands
   *    string namespace The full namespace for the command directory.
   *
   * @return array
   *   An array of Hook classes
   */
  private function getHooks(
    array $options = ['path' => NULL, 'namespace' => NULL]
  ) {
    $discovery = new CommandFileDiscovery();
    $discovery->setSearchPattern('*Hook.php')->setSearchLocations([]);
    return $discovery->discover($options['path'], $options['namespace']);
  }

}
