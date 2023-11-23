<?php
namespace com\atomicdev\dao;
use PDO;

include_once("$root/dao/base-dao.php");
include_once("$root/model/role.php");

class RoleDAO extends BaseDAO {
    private $seqName = "seq_roles";
    private $className = "\com\atomicdev\model\Role";

    public function createRolesByResidentId(array $entities, int $residentId) : array {
        if (!isset($entities) || empty($entities)) {
            return [];
        }

        $result = [];

        for ($i=0; $i < sizeof($entities); $i++) {
            $entity = $entities[$i];

            $stmt = $this->db->prepare($this->getDAOStatements()[CREATE]);
            $this->addBindParam($stmt, "seq", $this->seqName, PDO::PARAM_INT);
            $this->addBindParam($stmt, "type", $entity->type, PDO::PARAM_STR);
            $this->addBindParam($stmt, "resident_id", $entity->resident_id, PDO::PARAM_INT);
            $stmt->execute();

            $result[] = $stmt->fetchObject($this->className);
        }

        return $result;
    }

    public function getRoleByResidentId(int $resident_id) : array {
        $stmt = $this->db->prepare($this->getDAOStatements()[GET]);
        $this->addBindParam($stmt, "resident_id", $resident_id, PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_CLASS, $this->className);
    }

    public function deleteRolesByResidentId(int $residentId) : bool {
        $stmt = $this->db->prepare($this->getDAOStatements()[DELETE]);
        $this->addBindParam($stmt, "resident_id", $residentId, PDO::PARAM_INT);

        return $stmt->execute();
    }

    private function getDAOStatements() : array {
        return $GLOBALS[DB_STATEMENTS]["role"];
    }
}
?>