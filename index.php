<?php
require_once("config.php");
?>
<!DOCTYPE html>
<html>
<head>
<title>Recordae Iesu Pie – Bullarium</title>
<link rel="stylesheet" type="text/css" href="screen.css" />
</head>
<body>

<p>Serverzeit: <?= date("j.n.Y G:i:s") ?></p>


<h1>Sendungsrekorder</h1>

<h2>Laufende Aufnahmen</h2>
<pre>
<?= passthru(DO_AS_RECORDING_USER." ".CMD_PS) ?>
</pre>
<form action="kill.php">
<p>
	<input id="kill_pid" name="pid" placeholder="PID" />
	<button><label for="kill_pid">Prozess beenden</label></button>
</p>
</form>

<h2>Geplante Aufnahmen</h2>
<pre>
<?= passthru(DO_AS_RECORDING_USER." ".CMD_ATQ) ?>
</pre>
<form action="details.php">
<p>
	<input id="show_job" name="job" placeholder="Job#" />
	<button><label for="show_job">Aufnahme-Job anzeigen</label></button>
</p>
</form>
<form action="cancel.php">
<p>
	<input id="cancel_job" name="job" placeholder="Job#" />
	<button><label for="cancel_job">Geplante Aufnahme abbrechen</label></button>
</p>
</form>

<h2>Sendung aufnehmen</h2>
<form action="enqueue.php">
<p>
	<label for="rec_datetime">Wann:</label>
	<input id="rec_datetime" name="datetime" placeholder="[[CC]YY]MMDDhhmm[.SS]" value="<?= date("YmdHi") ?>"/>
</p>
<p>
	<label for="rec_duration">Dauer:</label>
	<input id="rec_duration" name="duration" size="3" /> min
</p>
<p>
	<label for="rec_title">Titel:</label>
	<input id="rec_title" name="title" />
</p>
<p>
	<label for="rec_source">Quelle:</label>
	<select id="rec_source" name="source">
	<?php foreach ($SOURCES as $group => $sources) { ?>
		<optgroup label="<?= $group ?>">
		<?php foreach ($sources as $sourceID => $source) { ?>
			<option value="<?= $sourceID ?>"><?= $source["name"] ?></option>
		<?php } ?>
		</optgroup>
	<?php } ?>
	</select>
</p>
<p><input type="submit" value="Aufnehmen"></p>
</form>


<h1>Aufgezeichnete Sendungen</h1>

<table>
<?php
$dir = opendir(RECORDING_DIR);
$file_list = array();
while ($file = readdir($dir))
	if (strpos($file, ".") !== 0)
		$file_list[$file] = "<tr><td><a href=\"".htmlentities("rec/$file")."\">".htmlentities($file)."</a></td><td><a href=\"delete.php?file=".htmlentities(urlencode($file))."\" onclick=\"return confirm('Wirklich löschen?')\">Löschen</a></td></tr>";
closedir($dir);

ksort($file_list);
foreach (array_reverse(array_values($file_list)) as $html)
	print $html;

?>
</table>

</body>
</html>
