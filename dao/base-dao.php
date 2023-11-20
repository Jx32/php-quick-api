<?php
namespace com\atomicdev\dao;
use PDO;

class BaseDAO {
    protected PDO $db;

    public function __construct(PDO $db) {
        $this->db = $db;
    }

    protected function commit() {
        $this->db->commit();
    }
    protected function rollback() {
        if ($this->db->inTransaction()) {
            $this->db->rollBack();
        }
    }
}
?>