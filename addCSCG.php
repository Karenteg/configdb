<?php

include 'mySqlFunctions.php';

$query="INSERT into CSCG (CSCGname) VALUES ('$_GET[CSCGname]')";
$con=connectDB();
if (addRecord($con,$query)) {
  header('HTTP/1.1 200');
}
else {
  header('HTTP/1.1 500 '.mysqli_error($con));
}
mysqli_close();
exit();
?>
