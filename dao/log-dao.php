<?php
namespace com\atomicdev\dao;
use com\atomicdev\model\Log;
use PDO;
use PDOException;

include_once("$root/dao/base-dao.php");
include_once("$root/model/log.php");

class LogDAO extends BaseDAO {
    private $seqName = "seq_log";

    public function createLog(Log $log) {
        try {
            $this->db->beginTransaction();

            // Log in php_error.log
            error_log(json_encode($log));
            // Log in database
            $stmt = $this->db->prepare($GLOBALS["DB_STATEMENTS"]["exception"]["create"]);
            $stmt->bindParam("message", $log->message, PDO::PARAM_STR);
            $stmt->bindParam("trace_id", $log->trace_id, PDO::PARAM_STR);
            $stmt->bindParam("seq_name", $this->seqName, PDO::PARAM_STR);
            $stmt->execute();

            $this->commit();
        } catch (PDOException $e) {
            $this->rollback();
            error_log("TraceId: ".$log->trace_id." Error logging on log table: ".
                    $e->getMessage()." ".$e->getTraceAsString());
        }
    }
}
?>