<?php
namespace com\atomicdev\model;
use DateTime;

abstract class Model {
    protected static function assignProperty(string $property, mixed $value, mixed $instance) : void {
        if (isset($value) && !is_null($value) && $value) {
            $instance->$property = $value;
        }
    }
    protected static function formatAndAssignDateTime(string $property, mixed $value, mixed $instance) : void {
        if (isset($value) && !is_null($value) && $value) {
            $dateTime = DateTime::createFromFormat(DateTime::RFC3339_EXTENDED, $value);

            if ($dateTime !== false) {
                $instance->$property = $dateTime;
            }
        }   
    }
}
?>