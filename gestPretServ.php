<!DOCTYPE HTML>

<html>
	<head>
		<link rel="stylesheet"href="gestPretServCSS.css">
		<link rel="stylesheet"href="buttonsCSS.css">
		<link rel="stylesheet"href="prevAndTopBCSS.css">
		<title>Gestionare Preturi si Servicii</title>
		
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
	<h2>Gestionare Preturi si Servicii</h2>
	</div>
	<?php
	include "db_connect.php";
	
	
		echo'<a href="adminAccount.php?mailUser='.$mailUser.'" class="previous">&laquo; Inapoi</a>'; 
		
		echo '<div class="gestPretServ">';
			echo '<div class="crServ">';
					echo '<a href="addServiciu.php?mailUser='.$mailUser.'">Adauga un nou serviciu</a>';
			echo'</div>';
			echo'<div class="vizPretServ">';   // inc div vizPretServ
				//Vizualizare angajati
				$sql2 = "SELECT idServ, numeServ, pretServ FROM servicii ";//ORDER BY numeAng ASC";
					$result= $conn->query($sql2);
					if ($result->num_rows > 0) {
						$color="lighterColor";
							while($row = $result->fetch_assoc()) {
								
								$idServ=$row["idServ"];
								$numeServ= $row["numeServ"];
								$pretServ= $row["pretServ"];
								
									echo'<div class="'.$color.'">';
											
											echo'<div class="vizPretDet">';
												echo '<a href="vizPretDet.php?mailUser='.$mailUser.'&idServ='.$idServ.'">Vezi preturi detaliate</a>';
											echo'</div>';
											
											echo'<div class="editPret">';
												//echo '<a href="editPret.php?mailUser='.$mailUser.'&numeServ='.$numeServ.'&pretServ='.$pretServ.'&idServ='.$idServ.'">Schimba pret</a>';
												echo '<a href="editPret.php?mailUser='.$mailUser.'&idServ='.$idServ.'">Schimba pret</a>';
											echo'</div>';
											
											echo'<div class="editNume">';
												echo '<a href="editNumeServ.php?mailUser='.$mailUser.'&numeServ='.$numeServ.'&idServ='.$idServ.'">Editeaza nume</a>';
											echo'</div>';
											
											echo'<div class="stergeServ">';
												echo '<a href="stergeServ.php?mailUser='.$mailUser.'&numeServ='.$numeServ.'&idServ='.$idServ.'&pretServ='.$pretServ.'">Sterge Serviciu</a>';
											echo'</div>';
											
										
											echo 'ID Serviciu: '.$idServ.' <br>';
											echo 'Nume: '.$numeServ.' <br>';
											echo 'Pret Standard: '.$pretServ.' <br>';
										
										
								
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
			echo'</div>';  //sf div vizPretServ
			
			
	?>	
			
						
						
	
		</div>  <!--sf div gestPretServ-->
	

	</body>
</html>
		