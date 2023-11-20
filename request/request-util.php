<?php
namespace com\atomicdev\request;

class RequestUtil {
    private function __construct() {}

    public static function buildRequest(): V1Request {
        $_POST = json_decode(file_get_contents('php://input'), true);
        $actual_link = (empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

        return new V1Request(
            $actual_link,
            $_SERVER['REQUEST_METHOD'],
            $_POST,
            getallheaders(),
            $_GET,
            []
        );
    }
}
?>