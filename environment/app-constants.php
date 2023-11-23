<?php
putenv("APP_NAME=secure-residential-api");
putenv("APP_VERSION=1.0.0-SNAPSHOT");
putenv("ENV=DEV");

// DAO constants //
const UPDATE = "update";
const DELETE = "delete";
const CREATE = "create";
const GET = "get";
const DB_STATEMENTS = "DB_STATEMENTS";
$GLOBALS[DB_STATEMENTS] = json_decode(file_get_contents("$root/database/database-statements.json"), true);

// Controller constants //
const MISSING_PARAMETERS = "Missing parameters";
?>