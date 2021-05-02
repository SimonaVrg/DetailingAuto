<!DOCTYPE HTML>

<html>
	<head>
		<link rel="stylesheet"href="prevAndTopBCSS.css">
		<link rel="stylesheet"href="buttonsCSS.css">
		<link rel="stylesheet"href="editProgrCSS.css">
		
		
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
		$idProg=$_GET['idProg'];
		
		$sql = "SELECT idAng FROM angajat WHERE mailAng ='$mailUser'";
		$result= $conn->query($sql);
		$row = $result->fetch_assoc();
		$idAng=$row["idAng"];
		
		
		//   $idAng=get_idAng_by_idProg($idProg);
							
		
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
	
		echo'<a href="vizProgrAng.php?mailUser='.$mailUser.'" class="previous">&laquo; Inapoi</a>'
		?>
	
	<div class="titlu">
	<h2>Editeaza o programare</h2>
	</div>
	<?php
	
	
		//Vizualizare programari client
		$today=date('Y-m-d');
		$sql2 = "SELECT dataProg, idMasina, tipCaroserie, listaServicii, pretProg, pretFinal, codVoucher, statusProg FROM programare WHERE idProg = '$idProg' AND idAng = '$idAng' ";
			$result= $conn->query($sql2);
			//if ($result->num_rows > 0) {
			echo '<div class="gestProgr">';	  // inc div gestProgr
			
			//	echo'<div class="vizProgr">';
					
					if ($result->num_rows > 0) {
					while($row = $result->fetch_assoc()) {
						
						$dataProg= $row["dataProg"];
						
						$listaServ= $row["listaServicii"];
						$codVoucher= $row["codVoucher"];
						$pretProg= $row["pretProg"];
						$pretFinal= $row["pretFinal"];
						$statusProg= $row["statusProg"];
						$idMasina= $row["idMasina"];
						$tipChoice= $row["tipCaroserie"];
						
						if($statusProg!='Finalizata' and $dataProg >= date('Y-m-d')){
							echo'<div class="'.$statusProg.'">';
							
								//echo'<div class="progrChSt">';
								
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
										$tipChoice=get_tipCaroserieNameByID($tipChoice);
										echo $tipChoice.'<br>';
									}
								}
								
								echo 'Lista servicii alese: '.$listaServ.' <br>';
								if($codVoucher!=NULL){ /* pana acum era if($codVoucher!='') -16.03.2021 */
									$procent=get_procent_by_codVoucher($codVoucher);
								echo 'Cod voucher folosit: '.$procent.'% '.$codVoucher.' <br>';
								}
								echo 'Pret estimativ: '.$pretProg.' <br>';
								if($pretFinal != NULL){
									echo 'Pret final: '.$pretFinal.' <br>';
								}
								echo 'Status: '.$statusProg.' <br>';
								if($statusProg =='Anulata'){ 
								echo'<b>Ne pare rau, data '.$dataProg.' nu mai este disponibila.<br> Va rugam sa editati  programarea folosind ID programarii, alegand o alta data.</b>';
									 
								}
								//echo'</div>';  /*inch div progrChSt*/
								
							echo'</div>'; //inch div statusProg
						}
					}
					}else{
						
						echo'<div class="nuExProgr">';
						  echo 'Nu exista o programare cu Nr. '.$idProg.' pentru '.$mailUser.'!';
						  echo'</div>';
					}
					
					
					
if ($result->num_rows > 0) { //daca exista programarea cu idProg pt mailUser
/*
daca s-a introdus idProg manual in bara de sus (in link, la GET) si nu exista idProg pt mailUser,
avem grija ca un client sa nu poata modifica o programare care nu este a lui, deci nu afisam formularul		
*/
			//	echo'<div class="formular">';
				
					
			//	echo '<div class="formEdit">';//formularul de edit programare!
			/*	echo 'Daca a fost folosit un cod promotional la programarea pe care vreti sa o editati, acesta va fi folosit automat si la progr pe care o editati.
Daca vreti sa folositi alt cod, selectati alt codPromotional				';
				*/
					$mailUser=$_GET['mailUser'];
					//echo $email.'<br>';
					$today = date('Y-m-d');
					
					$maxdate = date_create($today);
					date_modify($maxdate, '+2 months');
					//echo date_format($maxdate, 'Y-m-d');
					
					$mindate = date_create($today);
					date_modify($mindate, '+ 2 days');
					//echo date_format($mindate, 'Y-m-d');
					
						?>
	
						<form name="progrForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF?mailUser='.$mailUser.'"]);?>" method="POST">   <!--  -->
							<div class=progr>
							<br>
								
								<!-- functie pt verificat daca exista $idProgr pt $email 
										verificam statusul sa nu fie 'Finalizata'-->
								
								<p><b>Servicii:</b></p>
								<?php
									include "db_connect.php";
									
									//$sql = "SELECT numeServ, pretServ FROM serviciu";
									//cautam serviciile disponibile pentru masina aleasa
									if($tipChoice != 0){ //daca a fost selectat tipCaroserie
										$sql = "SELECT idServ, pretServ FROM pretserv WHERE idTip=$tipChoice";
										}
									else{
										// daca a ales 'Altul' - alt tip de caroserie
										//afisam toate serviciile cu un pret standard
										$sql = "SELECT idServ, pretServ FROM servicii ";
									}
									$result= $conn->query($sql);
									
									if ($result->num_rows > 0) {
										  // output data of each row
										  $i=1;
										  while($row = $result->fetch_assoc()) {
											$idServ= $row["idServ"];
											$pretServ= $row["pretServ"];
											if($tipChoice != 0 AND $pretServ == 0){
											/*daca nu a fost introdus un pret pt un serviciu+tipCaroserie, adica daca pretul din tabelul pretserv = 0
											atunci afisam pretul standard
											*/
											$pretServ=get_pretStandard_by_idServ($idServ);
											}
											$numeServ=get_numeServ_by_idServ($idServ);
											echo'
												<input id="ckbox" type="checkbox" name="serv'.$i.'" value="'.$idServ.'">
												<label for="serv'.$i.'" id="textc" >'.$numeServ.' : '.$pretServ.' RON </label><br>
												';
											$i=$i+1;
											

										  }
									} else {
									  echo "Nu pare rau, nu exista servicii disponibile momentan.";
									}
									
									echo'<br>
									  <label for="pretAng"><b>Pret:</b></label>
									  <input id="pretAng" name="pretAng" type="number" min="1"  placeholder="RON" required>
									  <br>
								  ';
								?>
								<br>
								<!--<label for="codVoucher"><b>Cod Voucher:</b></label>
								<input id="codVoucher" name="codVoucher" type="text" placeholder="AX67FG" pattern="[A-Z]{2}[0-9]{2}[A-Z]{2}" >
								<br><br>
								-->
					
							
						  </div>
						  
						  <button class="smallButton" name="submit" type="submit">Verifica pret</button>
						  <br><br>
						</form> 
						<!--verificari pt formular-->
			<?php
						if (isset($_POST['submit'])) {
							
							$idProg=$_GET['idProg'];																																																																																
							$mailUser=$_GET['mailUser'];
							echo '<br>ID Programare: '.$idProg.'<br>';
						
									
									//continuam cu calcularea pretului dupa servicii.
									$pretTot=0;
									//echo '<br>Ati ales urmatoarele servicii:<br>';
									$listServ="";
									foreach($_POST as $key => $value){
										if ( $key != 'pretAng'  && $key != 'submit'){
											$numeServ=get_numeServ_by_idServ($value);
											echo '-'.$numeServ . '<br>';
											//cream listaServ cu serviciile alese de client pentru a o trimite mai departe cand finalizam comanda
											if($listServ==""){
												$listServ=$listServ.$numeServ;
											}
											else{
													$listServ=$listServ.", ".$numeServ;
											}
											if($tipChoice != 0){
												//daca a fost selectat tipCaroserie
												$sql = "SELECT pretServ FROM pretServ where idServ = '$value' and idTip='$tipChoice'";   
											}
											else{
													$sql = "SELECT pretServ FROM servicii where idServ = '$value' ";
											}
											//$sql = "SELECT pretServ FROM serviciu where numeServ = '$value'";   
											$result= $conn->query($sql);
											$row = $result->fetch_assoc();
											$pretServ=$row["pretServ"];
											if($tipChoice != 0 AND $pretServ == 0){
												/*daca nu a fost introdus un pret pt un serviciu+tipCaroserie, adica daca pretul din tabelul pretserv = 0
												atunci afisam pretul standard
												*/
												$pretServ=get_pretStandard_by_idServ($idServ);
											}
											$pretTot += $pretServ;
											//echo 'pretTot: '.$pretTot.'<br>';
										}
									}
									if ($pretTot!=0){
									
									$pretAng=$_POST['pretAng'];
									echo '<br>Pret estimativ: '.$pretTot.' RON <br>';
									echo 'Pretul introdus manual: '.$pretAng.' RON <br>';
										if($pretAng	>=	$pretTot ){
											if ($codVoucher != NULL ){ //daca a fost introdus cod voucher 
												$procent=get_procent_by_codVoucher($codVoucher);
												$pretFinal=$pretAng-($procent/100*$pretAng);
												echo 'Reducere din codul promotional '.$codVoucher.':'.($procent/100*$pretAng).' RON <br>';
												echo 'Pret final: '.$pretFinal.' RON <br><br>';
												//$codVoucher=$_POST['codVoucher'];
												}
												else{//daca nu e valabil
													//$codVoucher = NULL;
													$pretFinal=$pretAng;
													//echo '<br>Pret final: '.$pretFinal.' RON <br>';
												}
												echo '<a class="smallButton" href="updateProgrAng.php?mailUser='.$mailUser.'&idProg='.$idProg.'&pretProg='.$pretTot.'&pretFinal='.$pretFinal.'&listServ='.$listServ.'">Salveaza schimbarile</a>';
				
										}
										else{
											echo 'Pentru serviciile alese, pretul trebuie sa fie minim '.$pretTot.'.<br><br>';
										}
									}
									else{
										echo'Nu se poate crea o programare care sa nu contina nici un serviciu.';
									}
						
				
				
					
					
					
			}
					
				
			//	echo '</div>'; //sfarsit fiv formEdit
			//echo'</div>'; //sfarsit div formular
							
}

			
			//	echo'</div>';//inch div viz
				
				
					
			
				
			echo '</div>'; //sf div gestProgr
			
		
		?>

	</body>
</html>
		