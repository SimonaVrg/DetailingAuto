<?php
//echo "Am intrat in addProgrProcess.php<br><br><br>";
include "db_connect.php";
include "functions2.php";

$mailUser=$_GET['mailUser'];
$dataProgr=$_GET['dataProgr'];
$codVoucher=$_GET['codVoucher'];
$listServ=$_GET['listServ'];
$pretFinal=$_GET['pretFinal'];
$idAng=$_GET['idAng'];
$idCl=$_GET['idCl'];
$carChoice=$_GET['carChoice'];
$tipChoice=$_GET['tipChoice'];
/*
echo 'mailUser='.$mailUser.'<br>';
echo 'dataProgr='.$dataProgr.'<br>';
echo 'codVoucher='.$codVoucher.'<br>';
echo 'listServ='.$listServ.'<br>';
echo 'pretFinal='.$pretFinal.'<br>';
echo 'idAng='.$idAng.'<br>';
echo 'idCl='.$idCl.'<br>';
*/
//echo 'Vreau sa adaug in addProgrProcess codVoucher:'.$codVoucher.'<br>';

if ($codVoucher != "noVoucher"){
		$sql = "INSERT INTO programare (idCl, dataProg, idAng, listaServicii, codVoucher, pretProg, idMasina, tipCaroserie) VALUES 
									('$idCl','$dataProgr','$idAng','$listServ','$codVoucher','$pretFinal','$carChoice','$tipChoice')";

}
else{
	$sql = "INSERT INTO programare (idCl, dataProg, idAng, listaServicii, codVoucher, pretProg, idMasina, tipCaroserie) VALUES 
									('$idCl','$dataProgr','$idAng','$listServ',NULL,'$pretFinal','$carChoice','$tipChoice')";
}

if($conn->query($sql) === TRUE){
	echo "Programarea a fost creata cu succes!";
	/*echo 'email='.$email.'<br>';
	echo 'codVoucher='.$codVoucher.'<br>';*/
	//dupa ce am adaugat programarea, mergem la cod voucher si schimbam disponibilitatea $codVoucher pt $email in "folosit"
	//abia acum mi-a generat idProgr, deci trebuie sa il selectez din baza de date acum, du
	//update_disp_voucher_to_fol($mailUser,$codVoucher);
	
	if ($codVoucher != "noVoucher"){
		echo 'Adaugam in codpromofolosit cu $codVoucher'.$codVoucher;
		add_codpromofolosit($codVoucher, $mailUser);
	}
	header("Location:vizProgr.php?mailUser=$mailUser");
}

else{
echo "Error: ".$sql."<br>".$conn->error;
}
$conn->close();

?>
