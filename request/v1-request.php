<?php
namespace com\atomicdev\request;

include_once("base-http-request.php");

class V1Request extends BaseHttpRequest {
    private array $env = [];

    public function __construct(string $url, string|null $method, array|null $body, 
                                array|null $headers, array|null $queryParams, array|null $env) {
        parent::__construct($url, $method, $body, $headers, $queryParams);
        $this->env = $env;
    }

    public function addEnvs (array $envVars) {
        foreach ($envVars as $key => $value) {
            $this->env[$key] = $value;
        }
    }

    public function getEnv(string $key) {
        return $this->env[$key] ?? null;
    }
    public function getEnvs() {
        return $this->env;
    }
}
?>