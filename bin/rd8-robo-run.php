<?php
/**
 * @file
 * Execute RD8 commands via Robo.
 */

use Lucacracco\RoboDrupal8\Robo\Rd8;
use Lucacracco\RoboDrupal8\Robo\Config\DefaultConfig;
use Lucacracco\RoboDrupal8\Robo\Config\YamlConfigProcessor;
use Robo\Common\TimeKeeper;
use Consolidation\Config\Loader\YamlConfigLoader;
use Symfony\Component\Console\Input\ArgvInput;
use Symfony\Component\Console\Output\ConsoleOutput;

// Start Timer.
$timer = new TimeKeeper();
$timer->start();

// Initialize input and output.
$input = new ArgvInput($_SERVER['argv']);
$output = new ConsoleOutput();

// Initialize configuration.
$config = new DefaultConfig($repo_root);
$loader = new YamlConfigLoader();
$processor = new YamlConfigProcessor();
$processor->add($config->export());
$processor->extend($loader->load($config->get('robo-drupal8.root') . '/template/configs/_base.yml'));
if ($input->hasArgument('environment')) {
  $processor->extend($loader->load($config->get('repo.root') . '/build/configs/' . $input->getArgument('environment') . '.yml'));
}
if ($input->hasOption('site')) {
  $processor->extend($loader->load($config->get('repo.root') . '/build/configs/' . $input->getOption('site') . '.yml'));
}
if ($input->hasOption('site') && $input->hasArgument('environment')) {
  $processor->extend($loader->load($config->get('repo.root') . '/build/configs/' . $input->getArgument('environment') . '-' . $input->getOption('site') . '.yml'));
}
$config->import($processor->export());
$config->populateHelperConfig();

// Execute command.
$blt = new Rd8($config, $input, $output);
$status_code = (int) $blt->run($input, $output);

// Stop timer.
$timer->stop();
if ($output->isVerbose()) {
  $output->writeln("<comment>" . $timer->formatDuration($timer->elapsed()) . "</comment> total time elapsed.");
}

exit($status_code);
