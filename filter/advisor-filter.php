<?php
namespace com\atomicdev\filter;
use com\atomicdev\exception\ApiException;
use com\atomicdev\request\BaseHttpResponse;
use com\atomicdev\request\V1Request;
include_once("$root/request/v1-request.php");
include_once("$root/request/base-http-response.php");
include_once("$root/exception/api-exception.php");
include_once("filter.php");
include_once("filter-chain.php");

/*
    This filter catches all API or Security exceptions then
    returns a friendly and formatted response.
    This filter must be at the top of the filter chain.
*/
class AdvisorFilter implements Filter {
    public function filter(V1Request &$request, BaseHttpResponse &$response, FilterChain $filterChain) {
        try {
            $filterChain->doChain($request, $response);
        } catch (ApiException $ae) {
            $response->setResponse($ae->getMessage());
            $response->setResponseCode($ae->getCode());
        }
    }
}
?>