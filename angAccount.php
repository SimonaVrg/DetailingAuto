<!DOCTYPE>
<html>
	<head>
		<link rel="stylesheet" href="angAccountCSS.css">
		<link rel="stylesheet" href="prevAndTopBCSS.css">
		<title> Cont Angajat</title>
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
			echo'<a href="angAccount.php?mailUser='.$mailUser.'">Acasa</a>';
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
			
			<?php echo '<a href="vizProgrAng.php?mailUser='.$mailUser.'">Programarile mele</a>';?> 
			<!-- din prigramarile mele pot schimba statusul unei comenzi in Finalizata-->
			<?php echo '<a href="zileLibere.php?mailUser='.$mailUser.'">Zile libere</a>';?>
			<!--<?php// echo '<a href="progrNoua.php?email='.$mailUser.'">Feedback primit</a>';?> -->
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
			
		</div>
	</div>
	
	
	
	

	</body>
</html>
		