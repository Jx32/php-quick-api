<?php
namespace com\atomicdev\controller;
use com\atomicdev\database\ResidentialPdoClient;
use com\atomicdev\request\V1Request;

include_once("$root/request/v1-request.php");
include_once("controller.php");
include_once("$root/database/residential-pdo-client.php");

class TestController extends Controller {
    public function getResponse(V1Request $request) : mixed {
        $response = [];
        $db = null;

        try {
            $db = ResidentialPdoClient::getConnection($request->getEnvs());
            $db->exec("SELECT * FROM residents");
        } finally {
            // Close database connection
            if ($db !== null) {
                $db = null;
            }
        }

        return $response;
    }
}
?>