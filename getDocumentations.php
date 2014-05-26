<?php

include 'mySqlFunctions.php';

$query="select title from documentation ORDER by title";
$con=connectDB();
select2table($con,$query);
mysqli_close();
?>
