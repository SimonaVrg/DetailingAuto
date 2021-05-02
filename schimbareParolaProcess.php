<?php
//echo "Am intrat in schimbareParolaProcess.php";
include "db_connect.php";
	
$par_n = $_POST['par_n'];


if ($token == 1 or $token == 0){
	//seful(tk=1) si angajatii(tk=0) au datele in acelasi tabel
	$sql = "UPDATE angajat SET parolaAng='$par_n' WHERE mailAng='$email'";

}
else{
	if ($token == -1){
		//echo $email.' ,you are now logged in as client '.$token.'<br>';
		$sql = "UPDATE client SET parolaCl='$par_n' WHERE mailCl='$email'";
	}
}


if($conn->query($sql) === TRUE){
	echo "Parola a fost schimbata cu succes!";
}
else{
echo "Error: ".$sql."<br>".$conn->error;
}
$conn->close();
?>
