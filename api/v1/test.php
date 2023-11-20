<?php
namespace com\atomicdev\api\v1;
use com\atomicdev\controller\TestController;
use com\atomicdev\request\RequestFacade;

include_once("../../v1-bootstrap.php");
include_once("$root/controller/test-controller.php");
include_once("$root/request/request-facade.php");

$controller = new TestController();
echo RequestFacade::doRequestWithController($controller, $root);
?>