<?php

include "db_connect.php";
include "functions2.php";


//echo "Am intrat in finProg.php<br><br><br>";
$idProg=$_GET['idProg'];
$idCl=$_GET['idCl'];
$mailUser=$_GET['mailUser'];
$codVoucher=$_GET['codVoucher'];	
/*
echo 'idProg='.$idProg.'<br>';
echo 'idCl='.$idCl.'<br>';
echo 'mailUser='.$mailUser.'<br>'; //email-ul angajatului
echo 'codVoucher='.$codVoucher.'<br>';

echo 'Vrem sa finalizam programarea cu id-ul:'.$idProg.'<br>';
*/
if ($codVoucher!=""){ // a fost folosit voucher
//daca programarea e finalizata, stergem ($email, $codVoucher) din tabelul voucher
	$mailCl=get_mailCl_by_idCl($idCl);
	//echo ' stergem ('.$mailCl.','.$codVoucher.')din tab voucher.<br>';
	delete_voucher($mailCl,$codVoucher);
}
update_status_to_fin($idProg);

						
header("Location:vizProgrAng.php?mailUser=$mailUser"); //ne intoarcem pe pagina angajatului


?>
