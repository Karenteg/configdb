<?php
session_start();
header("Content-type: text/javascript");

/*
if (!isset($_SESSION['username'])) {
	header('Location: index.html');
	exit();
}
*/

$query=$_GET[query];

if ( strlen($query) == 0) {
	header('HTTP/1.1 500 Not Enough Parameters');
	exit();
}

//$con = mysqli_connect("localhost","nicolas","nicolas","configDB");
$con = mysqli_connect($_SESSION['hostname'],$_SESSION['username'],$_SESSION['password'],$_SESSION['database']);

if (mysqli_connect_errno()) {
	header('HTTP/1.1 500 Failed to Connect: '. mysqli_connect_error());
	exit();
}

$result=mysqli_query($con,$query);
if ( !$result) {
	header('HTTP/1.1 500 Failed to Query: '.mysqli_error($con));
}
else {
	$myArray =	array();
	while($row = $result->fetch_array(MYSQL_ASSOC)) {
		$myArray[] = $row;
	}
	echo json_encode($myArray);
}
$result->close();
$con->close();
?>