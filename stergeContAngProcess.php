<?php
//echo "Am intrat in stergeContAngProcess.php";
include "db_connect.php";

//echo'Stergem angajatul cu id'.$idAng.'.<br>';

$idAng=$_GET['idAng'];
$mailUser=$_GET['mailUser'];

$sql = "DELETE FROM angajat WHERE idAng=$idAng";

if($conn->query($sql) === TRUE){
    echo "Contul angajatului cu id= '.$idAng.' a fost anulat!";
	//header("Location:vizProgr.php?mailUser='$mailUser');
	header("Location:gestContAng.php?mailUser=$mailUser");
}
else{
	echo "Error: ".$sql."<br>".$conn->error;
	}
$conn->close();

?>
