<?php
namespace com\atomicdev\controller;
use com\atomicdev\dao\ResidentDAO;
use com\atomicdev\database\ResidentialPdoClient;
use com\atomicdev\exception\BadRequestException;
use com\atomicdev\exception\ResourceNotFoundException;
use com\atomicdev\model\Resident;
use com\atomicdev\request\V1Request;
use Exception;

include_once("$root/request/v1-request.php");
include_once("$root/controller/crud-controller.php");
include_once("$root/exception/resource-not-found-exception.php");

include_once("$root/model/resident.php");
include_once("$root/dao/resident-dao.php");

class ResidentController extends CrudController {
    private string $notFoundMessage = "Resident not found";

    protected function put(V1Request $request): mixed {
        $entity = Resident::fromArray($request->getBody());
        $db = ResidentialPdoClient::getConnection($request->getEnvs());
        $dao = new ResidentDAO($db);

        try {
            $db->beginTransaction();

            if ($entity->id === 0) {
                $entity = $dao->createResident($entity);
            } else {
                $entity = $dao->updateResident($entity);

                if ($entity === false) {
                    throw new ResourceNotFoundException($this->notFoundMessage);
                }
            }

            $entity->pwd = null;
            ResidentialPdoClient::commit($db);

        } catch (Exception $e) {
            ResidentialPdoClient::rollback($db);
            throw $e;
        } finally {
            ResidentialPdoClient::finishConnection($db);
        }

        return $entity;
    }

    protected function get(V1Request $request): mixed {
        $id = $request->getQueryParams()["id"] ?? null;
        $db = ResidentialPdoClient::getConnection($request->getEnvs());
        $dao = new ResidentDAO($db);

        try {
            if (isset($id) && !is_null($id) && !is_nan($id)) {
                $entity = $dao->getResidentById($id);

                if ($entity === false) {
                    throw new ResourceNotFoundException($this->notFoundMessage);
                }

                $entity->pwd = null;
            } else {
                throw new BadRequestException(MISSING_PARAMETERS);
            }
        } finally {
            ResidentialPdoClient::finishConnection($db);
        }

        return $entity;
    }

    protected function delete(V1Request $request): mixed {
        $id = $request->getQueryParams()["id"] ?? null;
        $db = ResidentialPdoClient::getConnection($request->getEnvs());
        $dao = new ResidentDAO($db);

        try {
            if (isset($id) && !is_null($id) && !is_nan($id)) {
                $db->beginTransaction();

                $entity = $dao->deleteResidentById($id);

                if ($entity === false) {
                    throw new ResourceNotFoundException($this->notFoundMessage);
                }

                $entity->pwd = null;
                ResidentialPdoClient::commit($db);
            } else {
                throw new BadRequestException(MISSING_PARAMETERS);
            }
        } catch (Exception $e) {
            ResidentialPdoClient::rollback($db);
            throw $e;
        } finally {
            ResidentialPdoClient::finishConnection($db);
        }

        return $entity;
    }
}
?>