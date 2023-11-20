<?php
namespace com\atomicdev\request;

class BaseHttpResponse {
    private mixed $response;
    private int $responseCode = 200;
    private string $traceId;
    private array $headers = [];

    public function __construct() {
        $this->traceId = uniqid();

        $this->setHeader("Trace-Id", $this->traceId);
        $this->setHeader("Content-Type", "application/json");
    }

    public function getResponse(): mixed {
        return $this->response;
    }
    public function getResponseCode(): int {
        return $this->responseCode;
    }
    public function setResponse(mixed $response): BaseHttpResponse {
        if (gettype($response) !== "object" && gettype($response) !== "array") {
            $this->setHeader("Content-Type", "text/plain");
        } else {
            $this->setHeader("Content-Type", "application/json");
        }

        $this->response = $response;
        return $this;
    }
    public function setResponseCode(int $responseCode): BaseHttpResponse {
        $this->responseCode = $responseCode;
        return $this;
    }
    public function setTraceId(string $traceId): BaseHttpResponse {
        $this->traceId = $traceId;
        return $this;
    }
    public function getTraceId(): string {
        return $this->traceId;
    }
    public function getHeaders() : array {
        return $this->headers;
    }
    public function getHeader(string $name) : mixed {
        return $this->headers[$name];
    }
    public function setHeaders(array $headers): BaseHttpResponse {
        $this->headers = $headers;
        return $this;
    }
    public function setHeader(string $name, mixed $value): BaseHttpResponse {
        $this->headers[$name] = $value;
        return $this;
    }
}
?>