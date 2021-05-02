<?php

include "db_connect.php";
include "functions2.php";

//echo 'Am intrat in addZiLiberaProcess.php<br><br><br>';

$mailUser=$_GET['mailUser'];
$idAng=$_GET['idAng'];
$ziLibera=$_GET['ziLibera'];
//trebuie sa redistribuim programarile angajatului pentru ziua pe care i-o punem libera
redistr_progr_pt_o_zi($idAng,$ziLibera);
add_ziLibera($idAng,$ziLibera);
header("Location:gestZileLibere.php?idAng=$idAng&mailUser=$mailUser");

?>
