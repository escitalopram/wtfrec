<?php
require_once('config.php');

$dir = opendir(RECORDING_DIR);

if ($dir === false) {
	header("HTTP/1.0 500 Internal server error");
	die();
}

header("Content-Type: text/plain; charset=UTF-8");
while ($file = readdir($dir))
        if (strpos($file, ".") !== 0)
		echo BASE_URL . urlencode($file) . "\n";
closedir($dir);
?>

