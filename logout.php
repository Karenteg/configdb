<?php
session_start();

header("Content-type: text/javascript");

session_unset();
if (session_destroy()) {
	echo '{"status": true}';
}
else {
	echo '{"status": false}';
}
?>
