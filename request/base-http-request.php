<?php
namespace com\atomicdev\request;

class BaseHttpRequest {
    private $url;
    private $method;
    private $body;
    private $headers;
    private $queryParams;
    
    public function __construct(string $url, string $method, array $body, 
                                array $headers, array $queryParams) {
        $this->url = $url;
        $this->method = $method;
        $this->body = $body;
        $this->headers = $headers;
        $this->queryParams = $queryParams;
    }
}
?>