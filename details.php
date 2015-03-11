<?php
require_once("config.php");

header("Content-Type: text/plain");

$job_id = (int)$_REQUEST["job"];
passthru(DO_AS_RECORDING_USER." ".CMD_AT." -c $job_id");
