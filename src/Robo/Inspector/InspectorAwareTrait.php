<?php

namespace Lucacracco\RoboDrupal8\Robo\Inspector;

/**
 * Adds getters and setters for $this->inspector.
 */
trait InspectorAwareTrait {

  /**
   * The inspector.
   *
   * @var \Lucacracco\RoboDrupal8\Robo\Inspector\Inspector
   */
  private $inspector;

  /**
   * Sets $this->>inspector.
   *
   * @param \Lucacracco\RoboDrupal8\Robo\Inspector\Inspector $inspector
   *
   * @return \Lucacracco\RoboDrupal8\Robo\Inspector\InspectorAwareTrait
   */
  public function setInspector(Inspector $inspector) {
    $this->inspector = $inspector;

    return $this;
  }

  /**
   * Gets $this->inspector.
   *
   * @return \Lucacracco\RoboDrupal8\Robo\Inspector\Inspector
   */
  public function getInspector() {
    return $this->inspector;
  }

}
