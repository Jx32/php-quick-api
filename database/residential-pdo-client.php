<?php
namespace com\atomicdev\database;
use PDO;

class ResidentialPdoClient {
    public static function getConnection(array $env = []) : PDO {
        return new PDO(
            "pgsql:host=".$env["dbHost"].";port=".$env["dbPort"].";dbname=".$env["dbName"],
            $env["dbUsername"],
            $env["dbPassword"],
            [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
        );
    }

    public static function commit(PDO $db) {
        if (!is_null($db) && $db->inTransaction()) {
            $db->commit();
        }

    }
    public static function rollback(PDO $db) {
        if (!is_null($db) && $db->inTransaction()) {
            $db->rollBack();
        }
    }
    public static function finishConnection(PDO &$db) {
        $db = null;
    }
}
?>