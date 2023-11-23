<?php
namespace com\atomicdev\dao;
use PDO;
use PDOStatement;

class BaseDAO {
    protected PDO $db;

    public function __construct(PDO $db) {
        $this->db = $db;
    }

    protected function commit() {
        if ($this->db->inTransaction()) {
            $this->db->commit();
        }
    }
    protected function rollback() {
        if ($this->db->inTransaction()) {
            $this->db->rollBack();
        }
    }

    protected function addBindParam(PDOStatement &$stmt, string $namedParam, 
                                    mixed $value, int $type = PDO::PARAM_STR) {
        if (isset($value) && !is_null($value)) {
            $stmt->bindValue($namedParam, $value, $type);
        } else {
            $stmt->bindValue($namedParam, null, PDO::PARAM_NULL);
        }
    }
}
?>