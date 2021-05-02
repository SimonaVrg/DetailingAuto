<!DOCTYPE HTML>

<html>
	<head>
		<link rel="stylesheet"href="vizPretDetCSS.css">
		<link rel="stylesheet"href="buttonsCSS.css">
		<link rel="stylesheet"href="prevAndTopBCSS.css">
		<title>Gestionare Preturi si Servicii</title>
		
	</head>
	<body>
		<?php
	$mailUser=$_GET['mailUser'];
	$idServ=$_GET['idServ'];
	
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
	<h2>Gestionare Preturi si Servicii</h2>
	</div>
	<?php
	include "db_connect.php";
	include "functions2.php";
	
	
		echo'<a href="adminAccount.php?mailUser='.$mailUser.'" class="previous">&laquo; Inapoi</a>'; 
		
		echo '<div class="gestPretServ">';
		
			/*echo '<div class="crServ">';
					echo '<a href="addServiciu.php?mailUser='.$mailUser.'">Adauga un nou serviciu</a>';
			echo'</div>';*/
			
			echo'<div class="vizPretServ">';   // inc div vizPretServ
				//Vizualizare angajati
				$numeServ= get_numeServ_by_idServ($idServ);
				
				$pretStandard= get_pretStandard_by_idServ($idServ);
				//echo 'ID Serviciu: '.$idServ.' <br>';
				//echo '<p>Nume: '.$numeServ.' </p>';
				
				echo '<p>'.$numeServ.' </p>';
				echo '<p class="pret">Pret standard:'.$pretStandard.' </p>';
							
				$sql2 = "SELECT  idTip, pretServ FROM pretServ WHERE idServ=$idServ ";//ORDER BY numeAng ASC";
					$result= $conn->query($sql2);
					if ($result->num_rows > 0) {
						$color="lighterColor";
							
							while($row = $result->fetch_assoc()) {
								
								$pretServ= $row["pretServ"];
								$idTip= $row["idTip"];
								$tipCaroserieName= get_tipCaroserieNameByID($idTip);
									echo'<div class="'.$color.'">';
											
										echo'<div class="progrChDr">';
												echo'<div class="editPret">';
													echo '<a href="editPret.php?mailUser='.$mailUser.'&idTip='.$idTip.'&idServ='.$idServ.'">Schimba pret</a>';
												echo'</div>';
											/*
												echo'<div class="stergeServ">';
													echo '<a href="stergeServ.php?mailUser='.$mailUser.'&numeServ='.$numeServ.'&idServ='.$idServ.'&pretServ='.$pretServ.'">Sterge Serviciu</a>';
												echo'</div>';
												*/
										echo'</div>';  /*inch div progrChDr*/
										
										echo'<div class="progrChSt">';
										
											echo 'Tip Caroserie: '.$tipCaroserieName.' <br>';
											if ($pretServ == 0){
												echo 'Pret: '.$pretServ.' <br>';
												echo 'Pentru '.$numeServ.', tip caroserie: '.$tipCaroserieName.', va fi afisat pretul standard.';
											
											}
											else{
													echo 'Pret: '.$pretServ.' <br>';
											}
										
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
						echo 'Momentan nu exista preturi in functie de tipul de caroserie.';
					}
			echo'</div>';  //sf div vizPretServ
			
			
	?>	
			
						
						
	
		</div>  <!--sf div gestPretServ-->
	

	</body>
</html>
		