<?php
namespace com\atomicdev\request;

class V1Request extends BaseHttpRequest {
    private array $env = [];

    public function __construct(string $url, string $method, array $body, 
                                array $headers, array $queryParams, array $env) {
        parent::__construct($url, $method, $body, $headers, $queryParams);
        $this->env = $env;
    }

    public function addEnv (string $name, string $value) : V1Request {
        $this->env[$name] = $value;
        return $this;
    }
}
?>