<?php
namespace com\atomicdev\controller;
use com\atomicdev\request\V1Request;

include_once("$root/request/v1-request.php");
include_once("controller.php");

class TestController extends Controller {
    public function getResponse(V1Request $request) : mixed {
        return [
            "Test" => "TestVal"
        ];
    }
}
?>