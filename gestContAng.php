<!DOCTYPE HTML>

<html>
	<head>
		<link rel="stylesheet"href="gestContAngCSS.css">
		<link rel="stylesheet" href="prevAndTopBCSS.css">
		<title>Gestionare conturi angajati</title>
		
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
	
	<div class= "titlu" >
	<h2>Gestionare conturi angajati</h2>
	</div>
	<?php
	include "db_connect.php";
	
	
	echo'<a href="adminAccount.php?mailUser='.$mailUser.'" class="previous">&laquo; Inapoi</a>';

		echo '<div class="gestAng">';
			echo '<div class="crContAng">';
					echo '<a href="addContAng.php?mailUser='.$mailUser.'">Creeaza un cont nou de angajat</a>';
			echo'</div>';
			
			echo'<div class="vizAng">';   // inc div vizAng
				//Vizualizare angajati
				$sql2 = "SELECT idAng, numeAng, mailAng, nrTelAng, dataNaAng FROM angajat WHERE tokenAng = '0' ORDER BY idAng DESC";
					$result= $conn->query($sql2);
					if ($result->num_rows > 0) {
						$color="lighterColor";
							while($row = $result->fetch_assoc()) {
								
								$idAng=$row["idAng"];
								$numeAng= $row["numeAng"];
								$mailAng= $row["mailAng"];
								$nrTelAng= $row["nrTelAng"];
								$dataNaAng= $row["dataNaAng"];
									echo'<div class="'.$color.'">';
											
											echo'<div class="zileLibere">';
												echo '<a href="gestZileLibereNew.php?idAng='.$idAng.'&mailUser='.$mailUser.'">Zile libere</a>';
											echo'</div>';
											
											echo'<div class="editDetCont">';
												echo '<a href="editDetails.php?email='.$mailAng.'&mailUser='.$mailUser.'">Editeaza detalii cont</a>';
											echo'</div>';
											
											echo'<div class="stergeCont">';
												echo '<a href="stergeContAng.php?mailUser='.$mailUser.'&email='.$mailAng.'&idAng='.$idAng.'&numeAng='.$numeAng.'&nrTelAng='.$nrTelAng.'&dataNaAng='.$dataNaAng.'">Sterge Cont</a>';
											echo'</div>';
											
										
										echo 'ID: '.$idAng.' <br>';
										echo 'Nume: '.$numeAng.' <br>';
										echo 'E-mail: '.$mailAng.' <br>';
										echo 'Numar de telefon: '.$nrTelAng.' <br>';
										echo 'Data nasterii: '.$dataNaAng.' <br>';
							
									echo'</div>';
								if ($color =="lighterColor"){
									$color="color";
								}else{
									$color="lighterColor";
								}
							}
					}
					else{
						echo 'Nu exista nici un cont de angajat.';
					}
			echo'</div>';  //sf div vizAng
	?>	
			
						
						
	
		</div>  <!--sf div gestAng-->
	

	</body>
</html>
		