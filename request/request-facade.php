<?php
namespace com\atomicdev\request;
use com\atomicdev\controller\Controller;
use com\atomicdev\filter\AdvisorFilter;
use com\atomicdev\filter\ControllerFilter;
use com\atomicdev\filter\SecurityBasicFilter;
use com\atomicdev\filter\EnvironmentFilter;
use com\atomicdev\filter\FilterChain;
use com\atomicdev\request\V1Request;

include_once("v1-request.php");
include_once("base-http-response.php");
include_once("$root/controller/controller.php");
include_once("$root/filter/filter-chain.php");

include_once("$root/filter/environment-filter.php");
include_once("$root/filter/security-basic-filter.php");
include_once("$root/filter/advisor-filter.php");
include_once("$root/filter/controller-filter.php");

class RequestFacade {
    private function __construct() {}

    private static function buildRequest(): V1Request {
        // Try to append JSON body to $_POST assoc array
        $jsonBody = json_decode(file_get_contents('php://input'), true);
        if ($jsonBody !== null) {
            $_POST += $jsonBody;
        }

        $actualUri = (empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

        return new V1Request(
            $actualUri,
            $_SERVER['REQUEST_METHOD'],
            $_POST,
            getallheaders(),
            $_GET,
            []
        );
    }

    private static function buildFilterChain(Controller $controller, string $rootDirectory): FilterChain {
        return new FilterChain([
            new EnvironmentFilter($rootDirectory),
            new AdvisorFilter(),
            new SecurityBasicFilter(),
            new ControllerFilter($controller)
        ]);
    }

    private static function setPHPHeaders(BaseHttpResponse $response): void {
        header("Content-Type: application/json");
        http_response_code($response->getResponseCode());
    }

    public static function doRequestWithController(Controller $controller, string $rootDirectory) : string {
        $request = RequestFacade::buildRequest();
        $filterChain = RequestFacade::buildFilterChain($controller, $rootDirectory);
        $response = new BaseHttpResponse();

        $filterChain->doChain($request, $response);

        RequestFacade::setPHPHeaders($response);
        return json_encode($response->getResponse());
    }
}
?>