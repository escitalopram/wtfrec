<?php
require_once("config.php");

$file = realpath(RECORDING_DIR.$_REQUEST["file"]);

// Warning, unchecked "rm"! It can be used to delete anything that RECORDING_USER is allowed to delete.
shell_exec(DO_AS_RECORDING_USER." ".CMD_RM." ".escapeshellarg($file));

header("Location: ".BASE_URL);
?>
