<?php

namespace Lucacracco\RoboDrupal8\Robo\Commands\Validate;

use Lucacracco\RoboDrupal8\Robo\RoboDrupal8Tasks;

/**
 * Defines commands in the "validate:phpcs*" namespace.
 */
class PhpcsCommand extends RoboDrupal8Tasks {

  /**
   * Executes PHP Code Sniffer against all phpcs.filesets files.
   *
   * By default, these include custom themes, modules, and tests.
   *
   * @todo: description argument command.
   *
   * @command validate:phpcs
   */
  public function sniffFileSets($directory = '') {
    $bin = $this->getConfigValue('composer.bin');
    $dir = empty($directory) ? $this->getConfigValue('project.docroot') : $directory;
    $result = $this->taskExecStack()
      ->dir($dir)
      ->exec("$bin/phpcs")
      ->run();
    $exit_code = $result->getExitCode();
    if ($exit_code) {
      if ($this->input()->isInteractive()) {
        $this->fixViolationsInteractively();
        throw new \Exception("Initial execution of PHPCS failed. Re-run now that PHPCBF has fixed some violations.");
      }
      else {
        $this->logger->notice('Try running `rd8 fix:phpcbf` to automatically fix standards violations.');
        throw new \Exception("PHPCS failed.");
      }
    }
  }

  /**
   * Prompts user to fix PHPCS violations.
   */
  protected function fixViolationsInteractively() {
    $continue = $this->confirm("Attempt to fix violations automatically via PHPCBF?");
    if ($continue) {
      $this->invokeCommand('fix:phpcbf');
      $this->logger->warning("You must stage any new changes to files before committing.");
    }
  }

  /**
   * Executes PHP Code Sniffer against a list of files, if in phpcs.filesets.
   *
   * This command will execute PHP Codesniffer against a list of files if those
   * files are a subset of the phpcs.filesets filesets.
   *
   * @command validate:phpcs:files
   *
   * @param string $file_list
   *   A list of files to scan, separated by \n.
   *
   * @return int
   */
  public function sniffFileList($file_list) {
    $this->say("Sniffing directories containing changed files...");
    $files = explode("\n", $file_list);
    $files = array_filter($files);
    $exit_code = $this->doSniffFileList($files);

    return $exit_code;
  }

  /**
   * Executes PHP Code Sniffer against an array of files.
   *
   * @todo: update system to load file to sniff.
   *
   * @param array $files
   *   A flat array of absolute file paths.
   *
   * @return int
   */
  protected function doSniffFileList(array $files) {
    if ($files) {
      $temp_path = $this->getConfigValue('project.root') . '/tmp/phpcs-fileset';
      $this->taskWriteToFile($temp_path)
        ->lines($files)
        ->run();

      $bin = $this->getConfigValue('composer.bin') . '/phpcs';
      $bootstrap = __DIR__ . "/phpcs-validate-files-bootstrap.php";
      $command = "'$bin' --file-list='$temp_path' --bootstrap='$bootstrap' -l";
      if ($this->output()->isVerbose()) {
        $command .= ' -v';
      }
      elseif ($this->output()->isVeryVerbose()) {
        $command .= ' -vv';
      }
      $result = $this->taskExecStack()
        ->exec($command)
        ->printMetadata(FALSE)
        ->run();

      unlink($temp_path);

      return $result->getExitCode();
    }

    return 0;
  }

}
