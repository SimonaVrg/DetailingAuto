<?php
//echo "Am intrat in dataEditProcess.php";
include "db_connect.php";
	
$numeCl_n = $_POST['numeCl_n'];
$nrTelCl_n = $_POST['nrTelCl_n'];
$dataNaCl_n = $_POST['dataNaCl_n'];
/*
echo 'email_n:'.$email.'<br>';
echo 'numeCl_n:'.$numeCl_n.'<br>';
echo 'nrTelCl_n:'.$nrTelCl_n.'<br>';
echo 'dataNaCl_n:'.$dataNaCl_n.'<br>';
*/
$sql = "UPDATE client SET numeCl='$numeCl_n',nrTelCl='$nrTelCl_n',dataNaCl='$dataNaCl_n' WHERE mailCl='$email'";

if($conn->query($sql) === TRUE){
	echo "Informatiile au fost actualizate cu succes!";
}
else{
echo "Error: ".$sql."<br>".$conn->error;
}
$conn->close();
?>
