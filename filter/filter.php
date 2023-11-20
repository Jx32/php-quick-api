<?php
namespace com\atomicdev\filter;
use com\atomicdev\request\V1Request;

interface Filter {
    public function filter(V1Request &$request, array &$response, FilterChain $filterChain);
}
?>