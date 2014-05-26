<?php

include 'mySqlFunctions.php';

$query=$_GET[query];
$con=connectDB();
queryDB($con,$query);
mysqli_close();
?>
