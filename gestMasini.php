<!DOCTYPE HTML>

<html>
	<head>
		<link rel="stylesheet"href="gestMasiniCSS.css">
		<link rel="stylesheet"href="buttonsCSS.css">
		<link rel="stylesheet"href="prevAndTopBCSS.css">
		
		<link rel="stylesheet"href="alegeMasinaCSS.css">
		
		<title>Gestionare Masini</title>
		
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
	
	<div class="titlu">
	<h2>Gestionare Masini</h2>
	</div>
	<?php
	include "db_connect.php";
	
	
		echo'<a href="adminAccount.php?mailUser='.$mailUser.'" class="previous">&laquo; Inapoi</a>'; 
		
		echo '<div class="gestPretServ">';
			echo '<div class="crServ">';
					echo '<a href="adaugaMasini.php?mailUser='.$mailUser.'&add=model">Adauga un model de masina </a>';
			echo'</div>';
			
			echo '<div class="addTipCar">';
				echo '<a href="adaugaMasini.php?mailUser='.$mailUser.'&add=tipCaroserie">Adauga un tip de caroserie </a>';
			echo'</div>';
			
			echo'<div class="vizPretServSt">';   // inc div vizPretServ
				//Vizualizare angajati
				$sql2 = "select idMasina, marca, model from masini  ";//ORDER BY numeAng ASC";
					$result= $conn->query($sql2);
					if ($result->num_rows > 0) {
						$color="lighterColor";
							while($row = $result->fetch_assoc()) {
								
								$idMasina=$row["idMasina"];
								$marca= $row["marca"];
								$model= $row["model"];
								
									echo'<div class="'.$color.'">';
										echo'<div class="progrChDr">';
											
											echo'<div class="editNume">';
												echo '<a href="editNumeMasini.php?mailUser='.$mailUser.'&idMasina='.$idMasina.'">Editeaza </a>';
											echo'</div>';
											
											echo'<div class="stergeServ">';
												echo '<a href="stergeMasini.php?mailUser='.$mailUser.'&idMasina='.$idMasina.'">Sterge</a>';
											echo'</div>';
											
										echo'</div>';  /*inch div progrChDr*/
									
										echo'<div class="progrChSt">';
											
											echo $marca.' '.$model.' <br>';
										echo'</div>';  /*inch div progrChSt*/
										
								
									echo'</div>';
								if ($color =="lighterColor"){
									$color="color";
								}else{
									$color="lighterColor";
								}
							}
					}
					else{
						echo 'Ne pare rau, dar nu exista nici un serviciu momentan.';
					}
			echo'</div>';  //sf div vizPretServSt
			
			echo'<div class="vizPretServDr">';   //  div vizPretServDr
				//Vizualizare angajati
				$sql2 = "select idTip, numeTip from tipcaroserie ";//ORDER BY numeAng ASC";
					$result= $conn->query($sql2);
					if ($result->num_rows > 0) {
						$color="lighterColor";
							while($row = $result->fetch_assoc()) {
								
								$idTip=$row["idTip"];
								$numeTip= $row["numeTip"];
								
								
									echo'<div class="'.$color.'">';
										echo'<div class="progrChDr">';
											
											echo'<div class="editNume">';
												echo '<a href="editNumeMasini.php?mailUser='.$mailUser.'&idTip='.$idTip.'">Editeaza </a>';
											echo'</div>';
											
											echo'<div class="stergeServ">';
												echo '<a href="stergeMasini.php?mailUser='.$mailUser.'&idTip='.$idTip.'">Sterge</a>';
											echo'</div>';
											
										echo'</div>';  /*inch div progrChDr*/
									
										echo'<div class="progrChSt">';
										
											echo $numeTip.' <br>';
											
										
										echo'</div>';  /*inch div progrChSt*/
								
									echo'</div>';
								if ($color =="lighterColor"){
									$color="color";
								}else{
									$color="lighterColor";
								}
							}
					}
					else{
						echo 'Ne pare rau, dar nu exista nici un serviciu momentan.';
					}
			echo'</div>';  //sf div vizPretServDr
			
	?>	
			
						
						
	
		</div>  <!--sf div gestPretServ-->
	

	</body>
</html>
		