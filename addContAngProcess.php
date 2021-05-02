<?php
//echo "Am intrat in signInProcess.php";
include "db_connect.php";

$numeAng = $_POST["numeAng"];
$mailAng = $_POST["email"];
$nrTelAng = $_POST["nrTelAng"];
$dataNaAng = $_POST["dataNaAng"];
$parolaAng = $_POST["parolaAng"];
/*
echo 'vrem sa adaugam:<br>'.
	$numeAng.'<br>'.
	$mailAng.'<br>'.
	$nrTelAng.'<br>'.
	$dataNaAng.'<br>'.
	$parolaAng.'<br>';
	*/
$sql = "INSERT INTO angajat (tokenAng,numeAng,mailAng,nrTelAng,dataNaAng,parolaAng) 
						VALUES (0, '$numeAng','$mailAng','$nrTelAng','$dataNaAng','$parolaAng')";

if($conn->query($sql) === TRUE){
	echo "Contul angajat a fost creat cu succes!";
}
else{
echo "Error: ".$sql."<br>".$conn->error;
}
$conn->close();

?>
