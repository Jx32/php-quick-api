<?php
namespace com\atomicdev\request;

class BaseHttpResponse {
    public mixed $response;
    public int $responseCode = 200;
    public string $traceId;

    public function __construct() {
        $this->traceId = uniqid();
    }

    public function getResponse(): mixed {
        return $this->response;
    }
    public function getResponseCode(): int {
        return $this->responseCode;
    }
    public function setResponse(mixed $response): BaseHttpResponse {
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
}
?>