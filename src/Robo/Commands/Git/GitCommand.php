<?php

namespace Lucacracco\RoboDrupal8\Robo\Commands\Git;

use Lucacracco\RoboDrupal8\Robo\RoboDrupal8Tasks;
use Robo\Contract\VerbosityThresholdInterface;

/**
 * Defines commands in the "git:*" namespace.
 */
class GitCommand extends RoboDrupal8Tasks {

  /**
   * Validates a git commit message.
   *
   * @command git:commit-msg
   *
   * @return int
   */
  public function commitMsgHook($message) {
    $this->say('Validating commit message syntax...');
    $pattern = $this->getConfigValue('git.commit_msg.pattern');
    if (!preg_match($pattern, $message)) {
      $this->logger->error("Invalid commit message!");
      $this->say("Commit messages must conform to the regex $pattern");
      return 1;
    }
    return 0;
  }

  /**
   * Installs RD8 git hooks to local .git/hooks directory.
   *
   * @command git:git-hooks
   *
   * @throws \Exception
   */
  public function gitHooks() {
    foreach (['pre-commit', 'commit-msg'] as $hook) {
      $this->installGitHook($hook);
    }
  }

  /**
   * Validates staged files.
   *
   * TODO: load changed_files from git staged.
   * TODO: implement other validation.
   *
   * @command git:pre-commit
   *
   * @param string $changed_files
   *   A list of staged files, separated by \n.
   *
   * @return \Robo\Result
   */
  public function preCommitHook($changed_files) {
    $collection = $this->collectionBuilder();
    $collection->setProgressIndicator(NULL);
    $collection->addCode(
      function () use ($changed_files) {
        return $this->invokeCommands([
          'validate:phpcs:files' => ['file_list' => $changed_files],
          // 'validate:twig:files' => ['file_list' => $changed_files],
          // 'validate:yaml:files' => ['file_list' => $changed_files],
        ]);
      }
    );

    $changed_files_list = explode("\n", $changed_files);
    if (in_array('composer.json', $changed_files_list)
      || in_array('composer.lock', $changed_files_list)) {
      $collection->addCode(
        function () use ($changed_files) {
          return $this->invokeCommand('validate:composer');
        }
      );
    }

    $result = $collection->run();
    if ($result->wasSuccessful()) {
      $this->say("<info>Your local code has passed git pre-commit validation.</info>");
    }
    return $result;
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
