<?php
/*
    This file must be used just to include the neccesary
    bootstrap files.
    This file must be included in all entry points like Controllers.
*/
$context = "residential";
$root = realpath($_SERVER["DOCUMENT_ROOT"]) . "/" . $context;

include_once("$root/environment/app-constants.php");
?>