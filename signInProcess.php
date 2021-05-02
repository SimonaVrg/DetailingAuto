<?php
//echo "Am intrat in signInProcess.php";
include "db_connect.php";

$numeCl = $_POST["numeCl"];
$mailUser = $_POST["mailUser"];
$nrTelCl = $_POST["nrTelCl"];
$dataNaCl = $_POST["dataNaCl"];
$parolaCl = $_POST["parolaCl"];
$confParCl = $_POST["confParCl"];


$sql = "INSERT INTO client (tokenCl,numeCl,mailCl,nrTelCl,dataNaCl,parolaCl) VALUES (-1, '$numeCl','$mailUser','$nrTelCl','$dataNaCl','$parolaCl')";

if($conn->query($sql) === TRUE){
	echo "Contul a fost creat cu succes!";
}
else{
echo "Error: ".$sql."<br>".$conn->error;
}
$conn->close();
?>
