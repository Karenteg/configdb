<?php

include 'mySqlFunctions.php';

//$query="select file.name,path,CSCGname,fileFormat.name AS format from file JOIN (dirname,CSCG,fileFormat) ON (dirname_idDirname=idDirname AND idCSCG=CSCG_idCSCG AND idFileFormat=fileFormat_idFileFormat)";
$query="select name from file ORDER by name";
$con=connectDB();
$callback="displayFileDetails";
select2table($con,$query,$callback);
mysqli_close();
?>
