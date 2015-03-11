<?php
require_once("config.php");

$job = (int)$_REQUEST["job"];
shell_exec(DO_AS_RECORDING_USER." ".CMD_ATRM." $job");

header("Location: ".BASE_URL);
?>
