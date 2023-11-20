<?php
namespace com\atomicdev\database;
use PDO;

class ResidentialPdoClient {
    public static function getConnection(array $env = []) : PDO {
        $options = [PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"];

        $pdoInstance = new PDO(
            "mysql:host=".$env["dbHost"].";dbname=".$env["dbName"],
            $env["dbUsername"],
            $env["dbPassword"],
            $options
        );

        $pdoInstance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $pdoInstance;
    }
}
?>