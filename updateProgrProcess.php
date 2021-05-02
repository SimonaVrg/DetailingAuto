<?php
//echo "Am intrat in updateProgrProcess.php<br><br><br>";
include "db_connect.php";
include "functions2.php";

$mailUser=$_GET['mailUser'];
$idProg=$_GET['idProg'];
$dataProg=$_GET['dataProg'];
$idAng=$_GET['idAng'];
$listServ=$_GET['listServ'];
$codVoucher=$_GET['codVoucher'];
$pretFinal=$_GET['pretFinal'];
$statusProg=$_GET['statusProg'];

$codVoucher_c=get_codVoucher_by_idProg($idProg);
if($codVoucher_c == NULL){ //daca progr nu avea cod voucher
	if($codVoucher != "noVoucher"){ //si vrem sa ii adaugam codVoucher
		add_codpromofolosit($codVoucher, $mailUser); 
	}
	
}
else{ //daca programarea avea codVoucher_c
	if($codVoucher != "noVoucher"){ //si vrea sa foloseasca un cod
		if($codVoucher_c != $codVoucher){ //daca schimba codVoucher_c in codVoucher
			delete_codpromofolosit($codVoucher_c, $mailUser); //sterge codVoucher curent pe care nu l-a mai folosit
			add_codpromofolosit($codVoucher, $mailUser); 
		
		}
	}
	else{
		//daca vrea sa nu mai foloseasca nici un cod
		delete_codpromofolosit($codVoucher_c, $mailUser); //sterge codVoucher curent pe care nu l-a mai folosit
	}
}

/*
echo 'mailUser='.$mailUser.'<br>';
echo 'idProg='.$idProg.'<br>';
echo 'dataProg='.$dataProg.'<br>';
echo 'idAng='.$idAng.'<br>';
echo 'listServ='.$listServ.'<br>';
echo 'codVoucher='.$codVoucher.'<br>';
echo 'pretFinal='.$pretFinal.'<br>';
echo 'statusProg='.$statusProg.'<br>';
*/
if($codVoucher != "noVoucher"){
	$sql = "UPDATE programare SET 
		dataProg='$dataProg', 
		idAng='$idAng', 
		listaServicii='$listServ', 
		codVoucher='$codVoucher',
		pretProg='$pretFinal'
		WHERE idProg='$idProg' ";
}
else{
	$sql = "UPDATE programare SET 
	dataProg='$dataProg', 
	idAng='$idAng', 
	listaServicii='$listServ', 
	codVoucher=NULL,
	pretProg='$pretFinal'
	WHERE idProg='$idProg' ";
}
if($conn->query($sql) === TRUE){
	echo "Programarea a fost actualizata cu succes!";
	//dupa ce am adaugat programarea, mergem la cod voucher si schimbam disponibilitatea $codVoucher pt $email in "folosit"
	//abia acum mi-a generat idProgr, deci trebuie sa il selectez din baza de date acum, du
	//update_disp_voucher_to_fol($email,$codVoucher);
	if ($statusProg ='Amanata'){
		update_status_to_acc($idProg);
	}
	
	header("Location:vizProgr.php?mailUser=$mailUser");
}

else{
echo "Error: ".$sql."<br>".$conn->error;
}
$conn->close();

?>
