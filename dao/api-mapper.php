<?php
namespace com\atomicdev\dao;
use com\atomicdev\model\Log;
use com\atomicdev\model\Role;
use com\atomicdev\request\V1Request;
use Exception;

include_once("$root/request/v1-request.php");
include_once("$root/model/log.php");

class ApiMapper {
    public static function mapErrorLog(Exception $exception, V1Request $request) : Log {
        $traceId = $request->getHeaders()["Trace-Id"];
        $errorMessage = $exception->getMessage() . " " . $exception->getTraceAsString();

        $log = new Log();
        $log->trace_id = $traceId;
        $log->message = $errorMessage;
        $log->severity = "ERROR";
        return $log;
    }

    public static function mapRoleTypeToEntity(array $roles, int $residentId) : array {
        if (!isset($roles) || empty($roles)) {
            return [];
        }

        $result = [];

        foreach ($roles as $type) {
            $entity = new Role();
            $entity->type = $type;
            $entity->resident_id = $residentId;

            $result[] = $entity;
        }
        return $result;
    }
    public static function mapEntityRoleToType(array $entities) : array {
        if (!isset($entities) || empty($entities)) {
            return [];
        }

        $result = [];

        foreach ($entities as $entity) {
            $result[] = $entity->type;
        }
        return $result;
    }
}
?>