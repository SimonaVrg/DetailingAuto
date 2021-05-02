<!DOCTYPE>
<html>
	<head>
		<link rel="stylesheet" href="myAccountCSS.css">
		<link rel="stylesheet"href="prevAndTopBCSS.css">
		<title>Contul Meu</title>
	</head>
	<body>
	<?php
	include "db_connect.php";
	include "functions2.php";
	$mailUser=$_GET['mailUser'];
	
	$sql = "SELECT idCl, numeCl, nrTelCl, dataNaCl FROM client WHERE mailCl ='$mailUser'";
	$result= $conn->query($sql);
	$row = $result->fetch_assoc();
	
	$idCl= $row['idCl'];
	$numeCl= $row["numeCl"];
	$nrTelCl= $row["nrTelCl"];
	$dataNaCl= $row["dataNaCl"];

	
	echo' <div id="topbarid" class="topbar">
		<div id="tblid" class="tbl"> ';
			echo'<a href="index.php"> Deconecteaza-te </a>';
		echo'</div>
		<div id="tbrid" class="tbr">';
			echo'<a href="myAccount.php?mailUser='.$mailUser.'">Acasa</a>';
			echo'<a href="galerieF2.php?mailUser='.$mailUser.'">Galerie</a>';
			echo'<a href="aboutUs.php?mailUser='.$mailUser.'"> Despre Noi</a>';
			echo'<a href="aboutServices.php?mailUser='.$mailUser.'"> Servicii Oferite </a>';
			echo'<a href="reviews.php?mailUser='.$mailUser.'"> Reviews </a>';
	echo'	</div>
	</div>';
	
	
	
	if(are_progr_anulate($idCl)>0){
		echo' <div class="notificare"> ';
			echo '<a href="vizProgr.php?mailUser='.$mailUser.'" title="Aveti programari care trebuie editate!">!!!</a>';
		echo '</div> ';
		}
	?>
	<div class="welcome">
		<?php 
			echo '<h2>Bine ai venit, '.$row["numeCl"].'!</h2>';
		?>
	</div>

	<div id="mainid" class="mainDiv">
		<div id="progrid" class="progr">
			<!--<p>Programarile mele</p>-->
			<?php echo '<a href="progrNoua.php?mailUser='.$mailUser.'">Creeaza o programare noua</a>';?>
			<?php echo '<a href="alegeMasina.php?mailUser='.$mailUser.'">Creeaza o programare noua 2</a>';?>
			<?php echo '<a href="vizProgr.php?mailUser='.$mailUser.'">Vizualizare Programari</a>';?>
			<?php echo '<a href="giveReview.php?mailUser='.$mailUser.'">Lasa-ne un review</a>';?>
		</div>
		<div id="detailsid" class="details">
			<p>Detalii cont</p>
			<div class="detCl">
				<?php
					echo "Nume: " . $numeCl. "<br>";
					echo "Numar de telefon: " . $nrTelCl. "<br>";
					echo "Data nasterii: " . $dataNaCl. "<br>";
				?>
			</div>
			<?php echo '<a href="editDetails.php?email='.$mailUser.'&mailUser='.$mailUser.'">Editare detalii</a>';?>
			
			<!-- <a href="slideshow.php">slides </a> -->
		</div>
	</div>
	
	
	
	

	</body>
</html>
		