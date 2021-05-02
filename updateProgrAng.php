<?php
//echo "Am intrat in updateProgrProcess.php<br><br><br>";
include "db_connect.php";
include "functions2.php";

$mailUser=$_GET['mailUser'];
$idProg=$_GET['idProg'];
$listServ=$_GET['listServ'];
$pretProg=$_GET['pretProg'];
$pretFinal=$_GET['pretFinal'];

$sql = "UPDATE programare SET  
listaServicii='$listServ', 
pretProg='$pretProg',
pretFinal='$pretFinal'
WHERE idProg='$idProg' ";

if($conn->query($sql) === TRUE){
	echo "Programarea a fost actualizata cu succes!";
	header("Location:vizProgrAng.php?mailUser=$mailUser");
}

else{
echo "Error: ".$sql."<br>".$conn->error;
}
$conn->close();

?>
