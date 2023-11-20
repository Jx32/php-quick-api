<?php
namespace com\atomicdev\filter;
use com\atomicdev\request\BaseHttpResponse;
use com\atomicdev\request\V1Request;

include_once("$root/request/v1-request.php");
include_once("$root/request/base-http-response.php");

class FilterChain {
    private array $filters = [];

    public function __construct(array $filters = []) {
        $this->filters = $filters;
    }

    public function doChain(V1Request &$request, BaseHttpResponse &$response) {
        if (sizeof($this->filters) > 0) {
            array_shift($this->filters)->filter($request, $response, $this);
        }
    }
}
?>