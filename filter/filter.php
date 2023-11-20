<?php
namespace com\atomicdev\filter;
use com\atomicdev\request\BaseHttpResponse;
use com\atomicdev\request\V1Request;
include_once("$root/request/v1-request.php");
include_once("$root/request/base-http-response.php");
include_once("filter-chain.php");

interface Filter {
    public function filter(V1Request &$request, BaseHttpResponse &$response, FilterChain $filterChain);
}
?>