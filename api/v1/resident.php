<?php
namespace com\atomicdev\api\v1;
use com\atomicdev\controller\ResidentController;
use com\atomicdev\request\RequestFacade;

include_once("../../v1-bootstrap.php");
include_once("$root/controller/resident-controller.php");
include_once("$root/request/request-facade.php");

$controller = new ResidentController();
echo RequestFacade::doRequestWithController($controller, $root);
?>