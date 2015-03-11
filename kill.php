<?php
require_once("config.php");

$pid = (int)$_REQUEST["pid"];
shell_exec(DO_AS_RECORDING_USER." ".CMD_KILL." $pid");

header("Location: ".BASE_URL);
?>
