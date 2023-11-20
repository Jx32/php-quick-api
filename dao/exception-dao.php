<?php
namespace com\atomicdev\dao;
use com\atomicdev\request\V1Request;
use Exception;
use PDO;
use PDOException;

include_once("$root/dao/base-dao.php");
include_once("$root/request/v1-request.php");

class ExceptionDAO extends BaseDAO {

    public function createErrorLog(Exception $exception, V1Request $request) {
        $traceId = $request->getHeaders()["Trace-Id"];
        $errorMessage = $exception->getMessage() . " " . $exception->getTraceAsString();

        try {
            $this->db->beginTransaction();

            // Log in php_error.log
            error_log("TraceId: $traceId $errorMessage");
            // Log in database
            $stmt = $this->db->prepare($GLOBALS["DB_STATEMENTS"]["exception"]["create"]);
            $stmt->bindParam("message", $errorMessage, PDO::PARAM_STR);
            $stmt->bindParam("traceId", $traceId, PDO::PARAM_STR);
            $stmt->execute();

            $this->commit();
        } catch (PDOException $e) {
            $this->rollback();
            error_log("Error logging on log table: " . $e->getMessage() . " " . $e->getTraceAsString());
        }
    }
}
?>