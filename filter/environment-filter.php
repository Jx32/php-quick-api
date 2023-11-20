<?php
namespace com\atomicdev\filter;
use com\atomicdev\request\BaseHttpResponse;
use com\atomicdev\request\V1Request;
include_once("$root/request/v1-request.php");
include_once("$root/request/base-http-response.php");
include_once("filter.php");
include_once("filter-chain.php");

/*
    This filter adds the necessary env information to
    the request
*/
class EnvironmentFilter implements Filter {
    private string $rootDirectory;
    
    public function __construct(string $rootDirectory) {
        $this->rootDirectory = $rootDirectory;
    }

    public function filter(V1Request &$request, BaseHttpResponse &$response, FilterChain $filterChain) {
        $env = getenv("ENV");
        $envVars = [];

        if ($env === "PROD") {
            $envVars = json_decode(file_get_contents($this->rootDirectory . "/environment/env-prod.json"), true);
        } else {
            $envVars = json_decode(file_get_contents($this->rootDirectory . "/environment/env.json"), true);
        }

        $request->addEnvs($envVars);
        
        $filterChain->doChain($request, $response);
    }
}
?>