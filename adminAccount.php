<!DOCTYPE>
<html>
	<head>
		<link rel="stylesheet" href="adminAccountCSS.css">
		<link rel="stylesheet"href="prevAndTopBCSS.css">
		<title>Admin Account</title>
	</head>
	<body>
	<?php
	include "db_connect.php";
	$mailUser=$_GET['mailUser'];
	
	$sql = "SELECT numeAng, nrTelAng, dataNaAng FROM angajat WHERE mailAng ='$mailUser'";
	$result= $conn->query($sql);
	$row = $result->fetch_assoc();
	
	$numeAng= $row["numeAng"];
	$nrTelAng= $row["nrTelAng"];
	$dataNaAng= $row["dataNaAng"];

	
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
	
	<div class="welcome">
	<?php 
	echo '<h2>Bine ai venit, '.$row["numeAng"].'!</h2>';
	?>
	</div>
	<div id="mainid" class="mainDiv">
		<div id="progrid" class="progr">
			
			<?php echo '<a href="gestContAng.php?mailUser='.$mailUser.'">Gestionare conturi angajati</a>';?>
			<?php echo '<a href="gestPretServ.php?mailUser='.$mailUser.'">Gestionare preturi si servicii</a>';?>
			<?php echo '<a href="gestMasini.php?mailUser='.$mailUser.'">Gestionare masini</a>';?>
			<?php echo '<a href="vizProgrSef.php?mailUser='.$mailUser.'">Vizualizare Programari</a>';?>
			<?php echo '<a href="gestPromotii.php?mailUser='.$mailUser.'">Gestionare Promotii</a>';?>
		</div>
		<div id="detailsid" class="details">
			<p>Detalii cont</p>
			<div class="detCl">
				<?php
					echo "Nume: " . $numeAng. "<br>";
					echo "Nr telefon: " . $nrTelAng. "<br>";
					echo "Data nasterii: " . $dataNaAng. "<br>";
				?>
			</div>
			<?php echo '<a href="editDetails.php?email='.$mailUser.'&mailUser='.$mailUser.'">Editare detalii</a>';?>
			
			<!-- <a href="slideshow.php">slides </a> -->
		</div>
	</div>
	
	
	
	

	</body>
</html>
		