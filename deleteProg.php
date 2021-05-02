<?php

include "db_connect.php";
include "functions2.php";


//echo "Am intrat in deleteProg.php<br><br><br>";
$idProg=$_GET['idProg'];
$idCl=$_GET['idCl'];
$mailUser=$_GET['mailUser'];
$dataProg=$_GET['dataProg'];
$codVoucher=$_GET['codVoucher'];
$listServ=$_GET['listServ'];
$pretProg=$_GET['pretProg'];
$idAng=$_GET['idAng'];

						
echo 'idProg='.$idProg.'<br>';

//echo 'Vrem sa stergem programarea cu id-ul:'.$idProg.'.<br>';

if (status_progr($idProg) == "Finalizata" ){
	//echo 'Programarea este finalizata';
	header("Location:deleteProgProcess.php?mailUser=$mailUser&idProg=$idProg");
}

else{ //daca nu e finalizata
	if ($codVoucher!=''){  //si a fost folosit un voucher
		 //echo ' facem update_disp_voucher_to_disp($mailUser,$codVoucher) ';
		 update_disp_voucher_to_disp($mailUser,$codVoucher); // nu o sa mai avem nevoie de asta la varianta cu codpromotional cu data de inceput si sfarsit
		 
		 //daca porgramarea nu e finalizata, atunci doar stergem codul promotional din tabelul cu coduri folosite si acesta va putea fi folosit cat timp inca este valabil
		 delete_codpromofolosit($codVoucher, $mailUser);
		 /*
		 $sql2="SELECT disponibilitate FROM voucher WHERE mailCl='$mailUser' && codVoucher='$codVoucher'";
		$result= $conn->query($sql2);
		$row = $result->fetch_assoc();
		$disp_n=$row["disponibilitate"];
		*/
		//echo "Disponibilitatea '.$codVoucher.' a fost actualizata in '.$disp_n.'cu succes!";
	 }
	 
	header("Location:deleteProgProcess.php?mailUser=$mailUser&idProg=$idProg");
}

?>
