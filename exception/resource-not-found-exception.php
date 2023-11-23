<?php
namespace com\atomicdev\exception;

class ResourceNotFoundException extends \Exception {
    public function __construct($message, \Throwable $previous = null) {
        parent::__construct($message, 404, $previous);
    }
}
?>