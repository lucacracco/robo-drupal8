<?php

namespace Lucacracco\Drupal8\Robo\Task\Drush;

/**
 * Robo task: Set a state value.
 */
class StateSet extends DrushTask {

  /**
   * Value format.
   *
   * @var string
   */
  protected $format;

  /**
   * State key.
   *
   * @var string
   */
  protected $key;

  /**
   * State value.
   *
   * @var mixed
   */
  protected $value;

  /**
   * Constructor.
   *
   * @param string $key
   *   The state key.
   * @param mixed $value
   *   The value to assign to the state key.
   * @param string $format
   *   The type for the value. Use 'auto' to detect format from value. Other
   *   recognized values are 'string', 'integer', 'float' or 'boolean' for
   *   corresponding primitive type, or 'json', 'yaml' for complex types.
   */
  public function __construct($key, $value, $format = 'auto') {
    $this->format = $format;
    $this->key = $key;
    $this->value = $value;
  }

  /**
   * {@inheritdoc}
   */
  public function run() {
    return $this->drushStack()
      ->argForNextCommand(escapeshellarg($this->key))
      ->argForNextCommand(escapeshellarg($this->value))
      ->argForNextCommand(escapeshellarg('format=' . $this->format))
      ->drush('state-set')
      ->run();
  }

}
