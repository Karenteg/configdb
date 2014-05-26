<?php

include 'mySqlFunctions.php';

$query="select name from field ORDER by name";
$con=connectDB();
select2table($con,$query);
mysqli_close();
?>
