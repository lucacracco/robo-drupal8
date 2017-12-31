<?php

namespace Lucacracco\RoboDrupal8\Robo\Inspector;

/**
 * Requires setter for inspector.
 */
interface InspectorAwareInterface {

  /**
   * Sets $this->inspector.
   *
   * @param \Lucacracco\RoboDrupal8\Robo\Inspector\Inspector $inspector
   *
   * @return $this
   */
  public function setInspector(Inspector $inspector);

}
