<?php
/**
 * @file
 * Execute RD8 commands via Robo.
 */

// Initialize input and output.
$input = new \Symfony\Component\Console\Input\ArgvInput($_SERVER['argv']);
$output = new \Symfony\Component\Console\Output\ConsoleOutput();


// Start Timer.
$timer = new \Robo\Common\TimeKeeper();
$timer->start();
$output->writeln("<comment>Start: " . date("j F Y - g:i a") . "</comment>");

// Initialize configuration.
$config_initializer = new \Lucacracco\RoboDrupal8\Robo\Config\ConfigInitializer($repo_root, $input, $output);
$config = $config_initializer->initialize();

// Execute command.
$robo_drupal8 = new \Lucacracco\RoboDrupal8\Robo\RoboDrupal8($config, $input, $output);
$status_code = (int) $robo_drupal8->run($input, $output);

// Stop timer.
$timer->stop();
$output->writeln("<comment>" . $timer->formatDuration($timer->elapsed()) . "</comment> total time elapsed.");

exit($status_code);
