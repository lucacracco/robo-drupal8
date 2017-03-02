<?php

namespace Lucacracco\Drupal8\Robo\Utility;

/**
 * A helper class for wrapper Drupal core status information.
 */
class DrupalCoreStatus {

  /**
   * Druapl core status information.
   *
   * @var \stdClass
   */
  protected $status;

  /**
   * Constructor.
   *
   * @param \stdClass $status
   *   The Drupal core status information.
   */
  public function __construct(\stdClass $status) {
    $this->status = $status;
  }

  /**
   * Return Drupal core status information value.
   *
   * @param string $key
   *   The key of the status information to query.
   *
   * @return mixed|null
   *   The status information value on success, otherwise NULL.
   */
  public function get($key) {
    return isset($this->status->{$key}) ? $this->status->{$key} : NULL;
  }

}
