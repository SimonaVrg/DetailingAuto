<!DOCTYPE HTML>

<html>
	<head>
		<link rel="stylesheet"href="stergeContAngCSS.css">
		<link rel="stylesheet"href="buttonsCSS.css">
		<link rel="stylesheet"href="prevAndTopBCSS.css">
		
		
		<title>Sterge cont angajat</title>
		
	</head>
	<body>
	
		<?php
	$mailUser=$_GET['mailUser'];
		echo' <div id="topbarid" class="topbar">
		<div id="tblid" class="tbl"> ';
			echo'<a href="index.php"> Deconecteaza-te </a>';
		echo'</div>
		<div id="tbrid" class="tbr">';
			echo'<a href="adminAccount.php?mailUser='.$mailUser.'">Acasa</a>';
			echo'<a href="galerieF2.php?mailUser='.$mailUser.'">Galerie</a>';
			echo'<a href="aboutUs.php?mailUser='.$mailUser.'"> Despre Noi</a>';
			echo'<a href="aboutServices.php?mailUser='.$mailUser.'"> Servicii Oferite </a>';
			echo'<a href="reviews.php?mailUser='.$mailUser.'"> Reviews </a>';
	echo'	</div>
	</div>';
	?>
	
<?php

include "db_connect.php";
include "functions2.php";

//echo "Am intrat in stergeContAng.php<br>";

$mailUser=$_GET['mailUser'];
$mailAng=$_GET['email'];
$idAng=$_GET['idAng'];
$numeAng=$_GET['numeAng'];
$nrTelAng=$_GET['nrTelAng'];
$dataNaAng=$_GET['dataNaAng'];

echo '<div class="titlu">';
	echo '<h2>Sterge contul unui angajat</h2>';
echo '</div>';

echo'<a href="gestContAng.php?mailUser='.$mailUser.'" class="previous">&laquo; Inapoi</a>';


echo'<div class="infoAng">';
	echo '<p><b>Detalii cont:</b><br></p>';
	//echo 'ID: '.$idAng.' <br>';
	echo 'Nume: '.$numeAng.' <br>';
	echo 'E-mail: '.$mailAng.' <br>';
	echo 'Numar de telefon: '.$nrTelAng.' <br>';
	echo 'Data nasterii: '.$dataNaAng.' <br>';
echo'</div>';

echo '<div class="infoProg">';
$today=date('Y-m-d');
$sql="SELECT idProg, dataProg, pretProg FROM programare WHERE idAng = '$idAng' && statusProg != 'Finalizata' && dataProg >= '$today'";
$result = $conn->query($sql);
if($result->num_rows > 0) {
	echo 'Daca stergeti contul angajatului, o parte din programarile acestuia vor fi redirectionate catre alti angajati, iar o parte vor fi amanate pana cand clientul reprogrameaza.<br>';
	echo $numeAng.' are urmatoarele programari nefinalizate:<br>';
	while($row = $result->fetch_assoc()) {
		$idProg=$row["idProg"];
		$dataProg=$row["dataProg"];
		echo 'ID progrmare: '.$row["idProg"].'  ||  data: '.$dataProg.'  ||  pret: '.$row["pretProg"].'<br>';
	}
}else{
	echo '<div class="nuExProgNef">';
	echo $numeAng.' nu are programari nefinalizate.<br>';
	echo '</div>';
}

?>
	<form name="stergeAngajat" onsubmit="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">   <!--  -->
		<h3>Esti sigur ca vrei sa stergi contul angajatului cu id=<?php echo $idAng.'?<br>'; ?></h3>
		
		<button class="formButton" name="pressSterge" type="submit">Da, sterge contul</button>
		<button class="formButton" name="pressRenunta" type="submit">Nu, renunta</button>
	</form> 
<?php
if (isset($_POST['pressSterge'])) {
		echo 'Stergem contul ang cu id '.$idAng.'<br>';
		//include "stergeContAngProcess.php";
		redistr_progr($idAng);
		header("Location:stergeContAngProcess.php?idAng=$idAng &mailUser=$mailUser");
}
if (isset($_POST['pressRenunta'])) {
		echo 'Nu Stergem contul ang cu id '.$idAng.'<br>';
		header("Location:gestContAng.php?mailUser=$mailUser");
}
	echo '</div>';			
?>



	</body>
</html>
		
