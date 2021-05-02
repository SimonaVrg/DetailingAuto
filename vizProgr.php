<!DOCTYPE HTML>

<html>
	<head>
		<link rel="stylesheet"href="prevAndTopBCSS.css">
		<link rel="stylesheet"href="buttonsCSS.css">
		<link rel="stylesheet"href="vizProgrCSS.css">
		
		
		<title>Vizualizare Programari</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	</head>
	
		<script>
		function showDiv() {
		  document.getElementById('welcomeDiv').style.display = "block";
		  document.getElementById('close').style.display = "block";
		  //document.getElementById('showDiv').style.display = "none";
		  
		}

		function closeDiv() {
		  document.getElementById('welcomeDiv').style.display = "none";
		  document.getElementById('close').style.display = "none";
		 // document.getElementById('showDiv').style.display = "block";
		}
		
		function changeButtonText(string) {
		 // document.getElementById('showDiv').style.display = "block";
		 
		 document.getElementById('idProgramare').innerHTML = string;
		}
		
		
	</script>
	
	<body>
	
	
	<?php
		include "db_connect.php";
		include "functions2.php";
		
		$mailUser=$_GET['mailUser'];
		
		$sql = "SELECT idCl FROM client WHERE mailCl ='$mailUser'";
		$result= $conn->query($sql);
		$row = $result->fetch_assoc();
		$idCl=$row["idCl"];
		
		
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
	
	
		echo'<a href="myAccount.php?mailUser='.$mailUser.'" class="previous">&laquo; Inapoi</a>'
		?>
	
	<div class="titlu">
	<h2>Vizualizare Programari</h2>
	</div>
	<?php
	
	
		//Vizualizare programari client
		$today=date('Y-m-d');
		$sql2 = "SELECT idProg, idAng, idMasina, tipCaroserie, dataProg, listaServicii, pretProg, codVoucher, statusProg FROM programare WHERE idCl = '$idCl' and statusProg!='Finalizata' and dataProg >= '$today' ORDER BY idProg DESC";
			$result= $conn->query($sql2);
			//if ($result->num_rows > 0) {
			echo '<div class="gestProgr">';	  // inc div gestProgr
			
			echo '<div class="chSt">'; //incepe div chenar stanga	
			
				echo'<div class="vizProgr">';
					
					if ($result->num_rows > 0) {
					while($row = $result->fetch_assoc()) {
						$idProg=$row["idProg"];
						$dataProg= $row["dataProg"];
						$idAng= $row["idAng"];
						$listaServ= $row["listaServicii"];
						$codVoucher= $row["codVoucher"];
						$pretProg= $row["pretProg"];
						$statusProg= $row["statusProg"];
						$idMasina= $row["idMasina"];
						$tipChoice= $row["tipCaroserie"];
						if($statusProg!='Finalizata' and $dataProg >= date('Y-m-d')){
							echo'<div class="'.$statusProg.'">';
							
								echo'<div class="progrChDr">';
								
									/*echo'<div class="deleteProg">'; */
										//sterge programarea din baza de date; programarile afisate aici nu sunt finalizate
										//programarile finalizate sunt trecute in istoric
										echo '<a class="buttonE" href="deleteProg.php?idProg='.$idProg.'&idCl='.$idCl.'&mailUser='.$mailUser.'&dataProg='.$dataProg.'&codVoucher='.$codVoucher.'&listServ='.$listaServ.'&pretProg='.$pretProg.'&idAng='.$idAng.'">Anuleaza programarea</a>';
								/*	echo'</div>';*/
									
									/*echo'<div class="editProg">'; */
										echo '<a class="buttonE" href="editProgr.php?idProg='.$idProg.'&mailUser='.$mailUser.'">Editeaza programarea</a>';
									/*echo'</div>'; /*inch div editProg*/
									
								echo'</div>';  /*inch div progrChDr*/
								
								echo'<div class="progrChSt">';
								
								echo 'Nr. programare: '.$idProg.' <br>';
								echo 'Data programare: '.$dataProg.' <br>';
								if($idMasina == 0 and $tipChoice == 0){
									echo 'Nu a fost ales un model de masina. ';
								}
								else{
									echo 'Masina: ';
									if($idMasina != 0){
										$carName=get_carNameByID($idMasina);
										echo $carName.' ';
									}
									if($tipChoice != 0){
										$tipCaroserie=get_tipCaroserieNameByID($tipChoice);
										echo $tipCaroserie;
									}
									
								}
							
								echo '<br>Lista servicii alese: '.$listaServ.' <br>';
								if($codVoucher!=NULL){ /* pana acum era if($codVoucher!='') -16.03.2021 */
								echo 'Cod voucher folosit: '.$codVoucher.' <br>';
								}
								echo 'Pret estimativ: '.$pretProg.' <br>';
								if($pretFinal != NULL){
									echo 'Pret final: '.$pretFinal.' <br>';
								}
								echo 'Status: '.$statusProg.' <br>';
								if($statusProg =='Anulata'){ 
								echo'<b>Ne pare rau, data '.$dataProg.' nu mai este disponibila.<br> Va rugam sa editati  programarea folosind ID programarii, alegand o alta data.</b>';
									 
								}
								echo'</div>';  /*inch div progrChSt*/
								
							echo'</div>'; //inch div statusProg
						}
					}
					}else{
						
						echo'<div class="nuExProgr">';
						  echo "Nu exista programari urmatoare!";
						  echo'</div>';
					}
				echo'</div>';//inch div viz
				
				echo '<div class="istoricProgr">';
					echo '<a href="istoricProg.php?mailUser='.$mailUser.'">Istoric programari</a>';
				echo '</div>';
				
			echo '</div>'; //inch div chenar stanga	
			echo '<div class="chDr">'; //incepe div chenar dreapta	
			
				/*
				echo '<div class="crProgNoua">';
					echo '<a href="progrNoua.php?mailUser='.$mailUser.'">Creeaza o programare noua</a>';
				echo '</div>';
				*/
			
			
			
			
			echo '</div>'; //inch div chenar dreapta		
			echo '</div>'; //sf div gestProgr
			
		/*}
			else{
				echo'<div class="nuExProgr">';
			  echo "Nu exista programari momentan!";
			  echo'</div>';
			  echo '<div class="crProg">';
					echo '<a href="progrNoua.php?mailUser='.$mailUser.'">Creeaza o programare noua</a>';
				echo '</div>';
			}*/
		?>

	</body>
</html>
		