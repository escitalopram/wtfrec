<?php
require_once("config.php");

$when = (int)$_REQUEST["datetime"];
$minutes = (int)$_REQUEST["duration"];
$title = preg_replace("/[^a-zA-Z0-9\.,_\-]/", "_", $_REQUEST["title"]);

$seconds = $minutes*60;

$source = null;
foreach ($SOURCES as $group) {
	$source = $group[$_REQUEST["source"]];
	if (isset($source))
		break;
}
if (!isset($source)) die;

if (!is_array($source)) die;
$fname = RECORDING_DIR."$when-$title.".$source["suffix"];
switch ($source["type"]) {
	case "rtmpdump":
		$record = CMD_RTMPDUMP." -#vr ".escapeshellarg($source["url"])." -o ".escapeshellarg($fname)." --stop $seconds";
		break;
	case "streamripper":
		$record = CMD_STREAMRIPPER." ".escapeshellarg($source["url"])." --quiet -u ".escapeshellarg(USER_AGENT)." -l $seconds -A -a ".escapeshellarg($fname);
}

$at = DO_AS_RECORDING_USER." ".CMD_AT." -t ".escapeshellarg($when);
$cmd = "echo $record | $at 2>&1";
shell_exec($cmd);

header("Location: ".BASE_URL);
