<?php

/**
 * This is project's console commands configuration for Robo task runner.
 *
 * @see http://robo.li/
 */
class RoboFile extends \Robo\Tasks implements \Psr\Log\LoggerAwareInterface {

  use \Psr\Log\LoggerAwareTrait;

  /**
   * Directory used for test.
   */
  const RD8_TEST_DIR = 'tests/build';

  /**
   * Template project dir.
   */
  const RD8_TPL_TEST_DIR = 'test-project';

  /**
   * Robo-Drupal8 root.
   *
   * @var string
   */
  protected $rd8Root;

  /**
   * Bin RD8
   *
   * @var string
   */
  protected $bin;

  /**
   * This hook will fire for all commands in this command file.
   *
   * @hook init
   */
  public function initialize() {
    $this->rd8Root = __DIR__;
    $this->bin = $this->rd8Root . '/vendor/bin';
  }

  /**
   * Create a new project via symlink from current checkout of robo-drupal8.
   *
   * Local RD8 will be symlinked to project.
   *
   * @option project-dir The directory in which the test project will be
   *   created.
   */
  public function createFromSymlink($options = ['project-dir' => self::RD8_TEST_DIR]) {
    $test_project_dir = $this->rd8Root . "/" . $options['project-dir'];
    $this->prepareTestProjectDir($test_project_dir);

    // Create project test.
    $this->taskExecStack()
      ->dir($test_project_dir)
      ->exec("COMPOSER_PROCESS_TIMEOUT=2000 composer create-project drupal-composer/drupal-project:8.x-dev " . self::RD8_TEST_DIR . " --no-interaction")
      ->run();

    $this->taskExecStack()
      ->dir($test_project_dir)
      ->exec("composer config repositories.lucacracco/robo-drupal8 '{\"type\": \"path\",\"url\": \"{$this->rd8Root}\",\"options\": {\"symlink\": true}}'")
      ->run();

    $this->taskExecStack()
      ->dir($test_project_dir)
      ->exec("composer require lucacracco/robo-drupal8:dev-2.x-dev")
      ->run();

    // Run composer install after clear vendor directory.
    $this->taskExecStack()
      ->dir($test_project_dir)
      ->exec("rm -rf $test_project_dir/vendor")
      ->exec("composer install --prefer-dist")
      ->run();
  }

  /**
   * Create a new project using `drupal-composer/drupal-project:8.x-dev'.
   *
   * @option project-dir The directory in which the test project will be
   *   created.
   */
  public function createWithDrupalComposerProject($options = ['project-dir' => self::RD8_TEST_DIR]) {
    $test_project_dir = $this->rd8Root . "/" . $options['project-dir'];
    $this->prepareTestProjectDir($test_project_dir);

    $this->yell("Creating project with drupal-composer/drupal-project:8.x-dev.");

    // Create project test.
    $this->taskExecStack()
      ->dir($test_project_dir)
      ->exec("COMPOSER_PROCESS_TIMEOUT=2000 composer create-project drupal-composer/drupal-project:8.x-dev " . self::RD8_TEST_DIR . " --no-interaction")
      ->run();

    // Add required.
    $this->taskExecStack()
      ->dir($test_project_dir)
      ->exec("composer require lucacracco/robo-drupal8:2.x")
      ->run();
  }

  /**
   * Fixes RD8 internal code via PHPCBF.
   *
   * @command fix-code
   */
  public function fixCode() {
    $command = "'{$this->bin}/phpcbf'";
    $task = $this->taskExecStack()
      ->dir($this->rd8Root)
      ->exec($command);
    $result = $task->run();
    return $result->getExitCode();
  }

  /**
   * Sniffs RD8 internal code via PHPCS.
   *
   * @command sniff-code
   */
  public function sniffCode() {
    $task = $this->taskExecStack()
      ->dir($this->rd8Root)
      ->exec("{$this->bin}/phpcs")
      ->exec("composer validate");
    $result = $task->run();

    return $result->getExitCode();
  }

  /**
   * @param array $options
   */
  protected function createTestApp($options = [
    'project-type' => 'standalone',
    'project-dir' => self::RD8_TEST_DIR,
  ]) {
    switch ($options['project-type']) {
      case 'standalone':
        $this->createWithDrupalComposerProject($options);
        break;

      case 'symlink':
        $this->createFromSymlink($options);
        break;
    }
  }

  /**
   * Delete Dir before init project test.
   *
   * @param $test_project_dir
   *
   * @throws \Exception
   */
  protected function prepareTestProjectDir($test_project_dir) {
    if (file_exists($test_project_dir)) {
      $this->logger->warning("This will destroy the $test_project_dir directory!");
      $continue = $this->confirm("Continue?");
      if (!$continue) {
        $this->say("Please run <comment>sudo rm -rf $test_project_dir</comment>");
        throw new \Exception("$test_project_dir already exists.");
      }
      $this->taskFilesystemStack()
        ->chmod($test_project_dir, 0775, 0000, TRUE)
        ->taskDeleteDir($test_project_dir)
        ->run();
    }
  }

}
