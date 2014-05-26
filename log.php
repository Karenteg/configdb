<?php
session_start();

header("Content-type: text/javascript");

$server='localhost';
$database='configDB';
$username = $_POST['username'];
$password = $_POST['password'];

$conn = mysqli_connect($server, $username, $password, $database);

if (mysqli_connect_errno()) {
	header('HTTP/1.1 500 '.mysqli_connect_error());
	exit();
}
else {
	$_SESSION['username']=$username;
	$_SESSION['password']=$password;
	$_SESSION['server']=$server;
	$_SESSION['database']=$database;
	echo '{}';
	mysqli_close();
}
?>
