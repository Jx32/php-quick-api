<?php
namespace com\atomicdev\dao;
use com\atomicdev\model\Resident;
use PDO;
use PDOStatement;

include_once("$root/dao/base-dao.php");

class RoleDAO extends BaseDAO {
    private $seqName = "seq_resident";
    private $className = "\com\atomicdev\model\Resident";

    public function updateResident(Resident $entity) {
        $stmt = $this->db->prepare($this->getDAOStatements()[UPDATE]);
        $this->addBindParam($stmt, "id", $entity->id, PDO::PARAM_INT);
        $this->addCommonOrderedParams($stmt, $entity);

        $stmt->execute();

        return $stmt->fetchObject($this->className);
    }

    public function getResidentById(int $id) {
        $stmt = $this->db->prepare($this->getDAOStatements()[GET]);
        $this->addBindParam($stmt, "id", $id, PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->fetchObject($this->className);
    }

    public function deleteResidentById(int $id) {
        $stmt = $this->db->prepare($this->getDAOStatements()[DELETE]);
        $this->addBindParam($stmt, "id", $id, PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->fetchObject($this->className);
    }

    private function getDAOStatements() : array {
        return $GLOBALS[DB_STATEMENTS]["resident"];
    }

    private function addCommonOrderedParams(PDOStatement &$stmt, Resident $entity) : void {
        $this->addBindParam($stmt, "first_name", $entity->first_name, PDO::PARAM_STR);
        $this->addBindParam($stmt, "last_name", $entity->last_name, PDO::PARAM_STR);
        $this->addBindParam($stmt, "email", $entity->email, PDO::PARAM_STR);
        $this->addBindParam($stmt, "phone", $entity->phone, PDO::PARAM_STR);
        $this->addBindParam($stmt, "fm_token", $entity->fm_token, PDO::PARAM_STR);
        $this->addBindParam($stmt, "last_login", $entity->last_login, PDO::PARAM_STR);
        $this->addBindParam($stmt, "photo_url", $entity->photo_url, PDO::PARAM_STR);
        $this->addBindParam($stmt, "status", $entity->status, PDO::PARAM_STR);
        $this->addBindParam($stmt, "pwd", $entity->pwd, PDO::PARAM_STR);
        $this->addBindParam($stmt, "blocked_until", $entity->blocked_until, PDO::PARAM_STR);
        $this->addBindParam($stmt, "retries", $entity->retries, PDO::PARAM_INT);
    }
}
?>