<?php
namespace com\atomicdev\model;

include_once("$root/model/model.php");

class Log extends Model {
    public string $severity;
    public string $message;
    public string $trace_id;
}
?>