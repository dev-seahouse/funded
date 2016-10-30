<?php

class DatabaseException extends PDOException {
  private $defaultMsg = "Database Exception.";
  public function __construct($message = "", $code, Exception $previous) {
    parent::__construct($message = $this->defaultMsg, $code, $previous);
  }
}