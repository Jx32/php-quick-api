<?php
namespace com\atomicdev\model;
use DateTime;

abstract class Model {
    protected static function assignProperty(string $property, mixed $value, mixed $instance) : void {
        if (isset($value) && !is_null($value) && $value) {
            $instance->$property = $value;
        } else {
            if (!isset($instance->$property)) {
                $instance->$property = null;
            }
        }
    }
}
?>