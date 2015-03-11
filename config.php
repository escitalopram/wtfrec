<?php

// base URL, used for redirections
define(BASE_URL, "https://bullarium.xxxxxxxxxxxxxxxxxxxx.at/wtfrec/");
define(USER_AGENT, "WTFrec/0.3");

// system user for recording
define(RECORDING_USER, "bullarium");
define(CMD_SUDO, "/usr/local/bin/sudo");
define(DO_AS_RECORDING_USER, CMD_SUDO." -u ".RECORDING_USER);

// commands that will be run as recording user
/* Make sure that the PHP user is allowed to run
	sudo -u RECORDING_USER
   for these commands without password */
define(CMD_AT,   "/usr/bin/at");	// enqueue job
define(CMD_ATQ,  "/usr/bin/atq");	// show current job queue
define(CMD_ATRM, "/usr/bin/atrm");	// remove job from queue
define(CMD_KILL, "/bin/kill");		// kill running job
define(CMD_PS,   "/bin/ps -dux -ww");	// list running jobs
define(CMD_STREAMRIPPER, "/usr/local/bin/streamripper");	// to rip audio streams
define(CMD_RTMPDUMP,     "/usr/local/bin/rtmpdump");		// to dump video streams

// data directory, relative to wtfrec root (with trailing slash)
define(RECORDING_DIR, "rec/");

// sources for recording
$SOURCES = Array(
	"Radio" => Array(
		"hor" => Array(
			"name" => "Radio Horeb – Leben mit Gott",
			"type" => "streamripper",
			"url" => "http://rs16.stream24.org:8000/horeb.mp3",
			"suffix" => "mp3"
		),
		"rma" => Array(
			"name" => "Radio Maria Österreich",
			"type" => "streamripper",
			"url" => "http://live.radiomaria.at:8000/rma",
			"suffix" => "mp3"
		)
	),
	"TV" => Array(
		"bib" => Array(
			"name" => "Bibel.TV – Der christliche Familiensender.",
			"type" => "rtmpdump",
			"url" => "rtsp://mf.bibeltv.c.nmdn.net/bibeltv_live/BIBEL_TV_HQ-480p.stream",
			"suffix" => "flv"
		),
		"ktv" => Array(
			"name" => "KTV",
			"type" => "rtmpdump",
			"url" => "rtmp://85.214.122.245/ktv_hd/ktv2",
			"suffix" => "flv"
		)
	)
);
