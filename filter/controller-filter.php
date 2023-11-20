<?php
namespace com\atomicdev\filter;
use com\atomicdev\controller\Controller;
use com\atomicdev\request\BaseHttpResponse;
use com\atomicdev\request\V1Request;
include_once("$root/request/v1-request.php");
include_once("$root/request/base-http-response.php");
include_once("$root/controller/controller.php");
include_once("filter.php");
include_once("filter-chain.php");

/*
    This filter executes the given controller and sets the response
    from it.
*/
class ControllerFilter implements Filter {
    private Controller $controller;
    
    public function __construct(Controller $controller) {
        $this->controller = $controller;
    }

    public function filter(V1Request &$request, BaseHttpResponse &$response, FilterChain $filterChain) {
        // Execute controller response
        $controllerResponse = $this->controller->getResponse($request);
        // Set ctrl. response to http response
        $response->setResponse($controllerResponse);
        
        $filterChain->doChain($request, $response);
    }
}
?>