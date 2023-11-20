<?php
namespace com\atomicdev\controller;
use com\atomicdev\exception\BadRequestException;
use com\atomicdev\request\V1Request;

include_once("$root/request/v1-request.php");
include_once("$root/controller/controller.php");
include_once("$root/exception/bad-request-exception.php");

abstract class CrudController extends Controller {
    public function getResponse(V1Request $request) : mixed {
        if ($request->getMethod() == "POST" || $request->getMethod() == "PUT") {
            return $this->put($request);
        } else if ($request->getMethod() == "GET") {
            return $this->get($request);
        } else if ($request->getMethod() == "DELETE") {
            return $this->delete($request);
        }
        throw new BadRequestException("Unsupported HTTP method");
    }

    protected function put(V1Request $request) : mixed {
        throw new BadRequestException("Unsupported HTTP method");
    }
    
    protected function get(V1Request $request) : mixed {
        throw new BadRequestException("Unsupported HTTP method");
    }

    protected function delete(V1Request $request) : mixed {
        throw new BadRequestException("Unsupported HTTP method");
    }
}
?>