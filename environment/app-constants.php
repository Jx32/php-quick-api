<?php
putenv("APP_NAME=secure-residential-api");
putenv("APP_VERSION=1.0.0-SNAPSHOT");
putenv("ENV=DEV");

$GLOBALS["DB_STATEMENTS"] = json_decode(file_get_contents("$root/database/database-statements.json"), true);
?>