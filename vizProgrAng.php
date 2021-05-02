<!DOCTYPE HTML>

<html>
	<head>
		<link rel="stylesheet"href="vizProgrAngCSS.css">
		<link rel="stylesheet"href="prevAndTopBCSS.css">
		
		<title>Vizualizare Programari</title>
		
	</head>
	<body>
	
		<?php
		include "db_connect.php";
		include "functions2.php";
		
		$mailUser=$_GET['mailUser'];
		
		$sql = "SELECT numeAng, idAng FROM angajat WHERE mailAng ='$mailUser'";
		$result= $conn->query($sql);
		$row = $result->fetch_assoc();
		$idAng=$row["idAng"];
		$numeAng=$row["numeAng"];
		//echo '<br>idCl: '.$idCl.'<br>';
		
		//include "addProgrProcess.php"; //daca ajungem pe pagina asta din creare programare noua, sa imi afiseze programare creata cu succes; verificam ce parametri primeste pagina pentru asta
	
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
	
	
		echo'<a href="angAccount.php?mailUser='.$mailUser.'" class="previous">&laquo; Inapoi</a>'
	?>
	
	
	<div class="titlu">
	<h2>Vizualizare Programari</h2>
	</div>
		<?php
		//Vizualizare programari angajat
		
		
		
		$sql2 = "SELECT idProg, idCl, idMasina, tipCaroserie, dataProg, listaServicii, pretProg, pretFinal, codVoucher, statusProg FROM programare WHERE idAng = '$idAng' ORDER BY dataProg DESC";
	
			$result= $conn->query($sql2);
			if ($result->num_rows > 0) {
			echo '<div class="gestProgr">';	  // inc div gestProgr
				
				echo'<div class="vizProgr">';
					
					
				while($row = $result->fetch_assoc()) {
					$idProg=$row["idProg"];
					$dataProg= $row["dataProg"];
					$idCl= $row["idCl"];
					$listaServ= $row["listaServicii"];
					$codVoucher= $row["codVoucher"];
					$pretProg= $row["pretProg"];
					$pretFinal= $row["pretFinal"];
					$statusProg= $row["statusProg"];
					$idMasina= $row["idMasina"];
					$tipChoice= $row["tipCaroserie"];
					
					if($statusProg!='Finalizata' and $dataProg >= date('Y-m-d')){
					echo'<div class="'.$statusProg.'">';
						echo'<div class="progrChDr">';
						
							echo'<div class="editProg">';
								echo '<a href="editProgAng.php?mailUser='.$mailUser.'&idProg='.$idProg.'">Editeaza programarea</a>';
							echo'</div>';
						
						if( $dataProg == date('Y-m-d')) {
							echo'<div class="finProg">';
								echo '<a href="finProg.php?mailUser='.$mailUser.'&idProg='.$idProg.'&idCl='.$idCl.'&codVoucher='.$codVoucher.'">Finalizeaza programarea</a>';
							echo'</div>';
						}
						
						echo'</div>';  /*inch div progrChDr*/
								
						echo'<div class="progrChSt">';
								
							echo 'Nr. programare: '.$idProg.' <br>';
							
							echo 'Data programare: '.$dataProg.' <br>';
							if($idMasina == 0 and $tipChoice == 0){
									echo 'Nu a fost ales un model de masina. <br>';
								}
								else{
									echo 'Masina: ';
									if($idMasina != 0){
										$carName=get_carNameByID($idMasina);
										echo $carName.' ';
									}
									if($tipChoice != 0){
										$tipChoice=get_tipCaroserieNameByID($tipChoice);
										echo $tipChoice.'<br>';
									}
								}
								
							echo 'Lista servicii alese: '.$listaServ.' <br>';
							if($codVoucher!=NULL){
								echo 'Cod voucher folosit: '.$codVoucher.' <br>';
							}
						
							echo 'Pret estimativ: '.$pretProg.' <br>';
							if($pretFinal!=NULL){
								echo 'Pret final: '.$pretFinal.' <br>';
							}
							echo 'Status: '.$statusProg.' <br>';
							if($statusProg =='Anulata'){ 
								echo'<b>Aceasta programare va fi disponibila doar dupa ce clientul reprogrameaza.</b>';
							}
						echo'</div>';  /*inch div progrChSt*/
					echo'</div>';
					} //inch div statusProgr
					
				}
				echo'</div>'; //inch div vizProgr
				
				echo '<div class="istoricProgr">';
					echo '<br><a href="istoricProgAng.php?mailUser='.$mailUser.'">Istoric programari</a>';
				echo '</div>';
				
				echo '</div>'; //inch div gestProgr
				
			} else {
			 
			  echo'<div class="nuExProgr">';
				echo $numeAng.', nu exista programari momentan.';
			  echo'</div>';
			}
		?>

	</body>
</html>
		