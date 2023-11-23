<?php
namespace com\atomicdev\model;

include_once("$root/model/model.php");

class Role extends Model {
    public int $id = 0;
    public string $type;
    public int $resident_id;
}
?>