<?php
namespace com\atomicdev\exception;

class BadRequestException extends \Exception {
    public function __construct($message, \Throwable $previous = null) {
        parent::__construct($message, 400, $previous);
    }
}
?>