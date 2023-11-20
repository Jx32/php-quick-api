<?php
namespace com\atomicdev\filter;
use com\atomicdev\request\V1Request;

class EnvironmentFilter implements Filter {
    public function filter(V1Request &$request, array &$response, FilterChain $filterChain) {
        $filterChain->doChain($request, $response);
    }
}
?>