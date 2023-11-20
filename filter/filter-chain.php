<?php
namespace com\atomicdev\filter;
use com\atomicdev\request\V1Request;

class FilterChain {
    private array $filters = [];

    public function __construct(array $filters = []) {
        $this->filters = $filters;
    }

    public function doChain(V1Request &$request, array &$response) {
        if (sizeof($this->filters) > 0) {
            array_shift($this->filters)->filter($request, $response, $this);
        }
    }
}
?>