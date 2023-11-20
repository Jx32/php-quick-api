<?php
namespace com\atomicdev\api\v1;
use com\atomicdev\request\RequestUtil;

$request = RequestUtil::buildRequest();

header("Content-Type: application/json");
echo json_encode($request, true);
?>