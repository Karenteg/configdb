<?php

include 'mySqlFunctions.php';

$query="select file.name,path,CSCGname,fileFormat.name AS format from file JOIN (dirname,CSCG,fileFormat) ON (dirname_idDirname=idDirname AND idCSCG=CSCG_idCSCG AND idFileFormat=fileFormat_idFileFormat) WHERE file.name='$_GET[name]'";
$con=connectDB();
select2table1column($con,$query);

print <<<EOF
<br><span id=description>Description</span><br>
<textarea readonly rows="4" class="descArea">
This is where we'll put details
</textarea>
<br>
EOF;

$query="select field.name from field,file where file_idFile=idFile AND file.name='$_GET[name]'";
select2table($con,$query);

mysqli_close();
?>
