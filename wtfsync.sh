#!/bin/sh
if [ -z "$1" ] ; then
	echo Usage: $0 '<base url of the server>'
	echo ''
	echo 'Downloads new and resumes incomplete files from the specified wtfrec server to the current working directory.'
	echo ''
	echo 'Example:'
	echo '$'" $0 https://bullarium.katholische-wahrheit.at/wtfrec/"
	echo ''
else
	echo "Downloading from ${1}"
	echo wget -qO - "${1}sync.php"
	wget -qO - "${1}sync.php" | grep '^https\?://' | wget -ci -
fi
