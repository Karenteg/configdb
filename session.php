<?php
session_start();

header("Content-type: text/javascript");

$con = mysqli_connect($_SESSION['hostname'],$_SESSION['username'],$_SESSION['password'],$_SESSION['database']);

if (mysqli_connect_errno()) {
	header('HTTP/1.1 500 Failed to check session: '. mysqli_connect_error());
	exit();
}
else {
	echo '{}';
	mysqli_close();
}
?>
