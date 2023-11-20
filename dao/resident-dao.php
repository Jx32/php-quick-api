<?php
namespace com\atomicdev\dao;
use com\atomicdev\model\Resident;
use PDO;
use PDOException;

include_once("$root/dao/base-dao.php");
include_once("$root/model/resident.php");

class ResidentDAO extends BaseDAO {
    private $seqName = "seq_resident";

    public function putResident(Resident $resident) {
        $stmt = $this->db->prepare($GLOBALS["DB_STATEMENTS"]["exception"]["create"]);
        $stmt->bindParam("message", $log->message, PDO::PARAM_STR);
        $stmt->bindParam("trace_id", $log->trace_id, PDO::PARAM_STR);
        $stmt->bindParam("seq_name", $this->seqName, PDO::PARAM_STR);
        $stmt->execute();
    }
}
?>