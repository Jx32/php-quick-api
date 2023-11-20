<?php
namespace com\atomicdev\controller;
use com\atomicdev\request\V1Request;

include_once("$root/request/v1-request.php");

abstract class Controller {
    public abstract function getResponse(V1Request $request) : mixed;
}
?>