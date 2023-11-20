<?php
namespace com\atomicdev\controller;
use com\atomicdev\dao\ResidentDAO;
use com\atomicdev\database\ResidentialPdoClient;
use com\atomicdev\model\Resident;
use com\atomicdev\request\V1Request;

include_once("$root/request/v1-request.php");
include_once("$root/controller/crud-controller.php");

include_once("$root/model/resident.php");
include_once("$root/dao/resident-dao.php");

class ResidentController extends CrudController {
    protected function put(V1Request $request): mixed {
        $dto = Resident::fromArray($request->getBody());
        $db = ResidentialPdoClient::getConnection($request->getEnvs());
        $residentDao = new ResidentDAO($db);

        try {
            $db->beginTransaction();

            if (is_null($dto->id)) {

            } else {
    
            }
        } finally {
            ResidentialPdoClient::rollback($db);
            ResidentialPdoClient::finishConnection($db);
        }
        
        return $dto;
    }
    protected function get(V1Request $request): mixed {

    }
}
?>