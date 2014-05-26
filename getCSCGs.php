<?php

include 'mySqlFunctions.php';

$query="SELECT CSCGname from CSCG ORDER by CSCGname";
$con=connectDB();
select2table($con,$query);
mysqli_close();
?>
