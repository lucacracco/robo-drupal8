<?php

namespace Lucacracco\Drupal8\Robo\Task\Drush;

/**
 * Robo task: Enable extension.
 */
class EnableExtension extends DrushTask {

  /**
   * Extensions.
   *
   * @var array
   */
  protected $extensions;

  /**
   * Command to exec.
   *
   * @var string
   */
  protected $command = "pm-enable";

  /**
   * Constructor.
   *
   * {@inheritdoc}
   * @param array $extensions
   *   An array of names for extensions to enable.
   */
  public function __construct(array $extensions, $uri = NULL) {
    parent::__construct($uri);
    $this->extensions = $extensions;
  }

  /**
   * {@inheritdoc}
   */
  public function run() {
    foreach ($this->extensions as $extension) {
      $this->drushStack()->argForNextCommand(escapeshellarg($extension));
    }
    $this->collection->add(
      $this->drushStack()->drush($this->command)
    );
    return parent::run();
  }

}
