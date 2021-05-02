<?php

include "db_connect.php";
include "functions2.php";

//echo 'Am intrat in deleteProgProcess.php<br><br><br>';

$mailUser=$_GET['mailUser'];
$idProg=$_GET['idProg'];

//echo 'Vrem sa stergem programarea cu id-ul:'.$idProg.'.<br>';

$sql = "DELETE FROM programare WHERE idProg=$idProg";

if($conn->query($sql) === TRUE){
	echo "Programarea a fost stearsa!";

	header("Location:vizProgr.php?mailUser=$mailUser");
}

else{
echo "Error: ".$sql."<br>".$conn->error;
}
$conn->close();

?>
