<?php
namespace com\atomicdev\request;

class BaseHttpRequest {
    private $url;
    private $method;
    private $body;
    private $headers;
    private $queryParams;
    
    public function __construct(string $url, string|null $method, array|null $body, 
                                array|null $headers, array|null $queryParams) {
        $this->url = $url;
        $this->method = $method;
        $this->body = $body;
        $this->headers = $headers;
        $this->queryParams = $queryParams;
    }

    public function getUrl(): string {
        return $this->url;
    }
    public function getMethod(): string {
        return $this->method;
    }
    public function getBody(): array {
        return $this->body;
    }
    public function getHeaders(): array {
        return $this->headers;
    }
    public function getQueryParams(): array {
        return $this->queryParams;
    }
}
?>