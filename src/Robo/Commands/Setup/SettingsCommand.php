<?php

namespace Lucacracco\RoboDrupal8\Robo\Commands\Setup;

use Lucacracco\RoboDrupal8\Robo\RoboDrupal8Tasks;
use Robo\Contract\VerbosityThresholdInterface;

/**
 * Class SettingsCommand.
 *
 * @package Lucacracco\RoboDrupal8\Robo\Commands\Setup
 */
class SettingsCommand extends RoboDrupal8Tasks {

  /**
   * Installs RD8 git hooks to local .git/hooks directory.
   *
   * @command setup:git-hooks
   *
   * @throws \Exception
   */
  public function gitHooks() {
    foreach (['pre-commit', 'commit-msg'] as $hook) {
      $this->installGitHook($hook);
    }
  }

  /**
   * Installs a given git hook.
   *
   * This symlinks the hook into the project's .git/hooks directory.
   *
   * @param string $hook
   *   The git hook to install. E.g., 'pre-commit'.
   *
   * @throws \Exception
   */
  protected function installGitHook($hook) {
    if ($this->getConfigValue('git.hooks.' . $hook)) {
      $this->say("Installing $hook git hook...");
      $source = $this->getConfigValue('git.hooks.' . $hook) . "/$hook";
      $dest = $this->getConfigValue('git.root') . "/.git/hooks/$hook";

      $result = $this->taskFilesystemStack()
        ->mkdir($this->getConfigValue('git.root') . '/.git/hooks')
        ->remove($dest)
        ->symlink($source, $dest)
        ->stopOnFail()
        ->setVerbosityThreshold(VerbosityThresholdInterface::VERBOSITY_VERBOSE)
        ->run();

      if (!$result->wasSuccessful()) {
        throw new \Exception("Unable to install $hook git hook.");
      }
    }
    else {
      $this->say("Skipping installation of $hook git hook");
    }
  }

}
