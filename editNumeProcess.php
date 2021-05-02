<?php
//echo "Am intrat in dataEditProcess.php";
include "db_connect.php";

//in functie de token, alegem in care tabel trebuie sa editam
if ($token == 1 or $token == 0){
	//seful(tk=1) si angajatii(tk=0) au datele in acelasi tabel
	$sql = "UPDATE angajat SET numeAng='$nume_n' WHERE mailAng='$email'";
}
else{
	if ($token == -1){
		//echo $email.' ,you are now logged in as client '.$token.'<br>';
		$sql = "UPDATE client SET numeCl='$nume_n' WHERE mailCl='$email'";
	}
}

if($conn->query($sql) === TRUE){
	echo "Numele a fost actualizat cu succes!";
}
else{
echo "Error: ".$sql."<br>".$conn->error;
}
$conn->close();
?>
