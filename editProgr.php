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
	<h2>Editeaza o programare</h2>
	</div>
	<?php
	
	
		//Vizualizare programari client
		$today=date('Y-m-d');
		$sql2 = "SELECT idAng, dataProg, idMasina, tipCaroserie, listaServicii, pretProg, codVoucher, statusProg FROM programare WHERE idProg = '$idProg' AND idCl = '$idCl' ";
			$result= $conn->query($sql2);
			//if ($result->num_rows > 0) {
			echo '<div class="gestProgr">';	  // inc div gestProgr
			
			//	echo'<div class="vizProgr">';
					
					if ($result->num_rows > 0) { 
					while($row = $result->fetch_assoc()) {
						
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
							
								//echo'<div class="progrChSt">';
								
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
										$tipCaroserie=get_tipCaroserieNameByID($tipChoice);
										echo $tipCaroserie;
									}
								}
								
								echo '<br>Lista servicii alese: '.$listaServ.' <br>';
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
							<br><br>
								
								<!-- functie pt verificat daca exista $idProgr pt $email 
										verificam statusul sa nu fie 'Finalizata'-->
								<label for="dataProgr"><b>Data:</b></label>
								<input id="dataProgr"  name="dataProgr" type="date" placeholder="'dd-mm-yyyy'?>" max="<?php echo date_format($maxdate, 'Y-m-d')?>"  min="<?php echo date_format($mindate, 'Y-m-d')?>" required>
								<br><br>
								
								<p><b>Servicii:</b></p>
								<?php
									include "db_connect.php";
									
									//$sql = "SELECT numeServ, pretServ FROM serviciu";
									//cautam serviciile disponibile pentru masina aleasa
									if($tipChoice != 0){
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
								?>
								<br>
								<!--<label for="codVoucher"><b>Cod Voucher:</b></label>
								<input id="codVoucher" name="codVoucher" type="text" placeholder="AX67FG" pattern="[A-Z]{2}[0-9]{2}[A-Z]{2}" >
								<br><br>
								-->
								
								<?php
								/* 16.03.2021 8:14
								adaugam dropdownlist pentru codPromotional la updateProgramare
								START AICI
								*/
					//if($codVoucher == NULL){ // daca programarea nu a avut aplicat un codVoucher, clientul poate sa adauge acum daca are disponibil
						
						setlocale(LC_ALL, 'ro_RO');
						
						//afiseaza toate codurile din coduripromo. Avem nevoie sa le afiseze doar pe cele disponibile pentru un client si care sunt valabile in functie de startDate si endDate. coduripromo minus coduripromofolosite dupa mailCl
						//$sql= "SELECT codVoucher FROM coduripromo "; 
						$today=date('Y-m-d');
						
						$sql= " select cod.codVoucher, cod.procent, cod.startDate, cod.endDate from coduripromo as cod 
						WHERE 
						cod.startDate<='$today' AND cod.endDate>='$today'
						AND
						cod.codVoucher NOT IN (select codFol.codVoucher from coduripromofolosite as codFol WHERE mailCl='$mailUser' ) ";
						
								$result = $conn->query($sql);
								
							if ($result->num_rows > 0 || $codVoucher != NULL) {
								//daca sunt coduri disponibile sau programarea are deja cod
								//pentru a putea renunta la cod daca vrem
								echo '<b>Cod Promotional:</b>';
									echo'<select name="voucherChoice">';
										 echo'<option value="noVoucher"></option>'; /* in caz ca utilizatorul nu alege nici un codVoucher*/
										
									while($row = $result->fetch_assoc()) {
										echo $row['codVoucher'].'<br>';
										 echo'<option value="'.$row['codVoucher'].'">'.$row['procent'].'% '.$row['codVoucher'].' : '.strftime("%e %b %Y",strtotime($row[startDate])).' - '.strftime("%e %b %Y",strtotime($row[endDate])).'</option>';
										}
										if($codVoucher != NULL){
										//	$procent=get_procent_by_codVoucher($codVoucher);
											$startDate=get_startDate_by_codVoucher($codVoucher);
											$endDate=get_endDate_by_codVoucher($codVoucher);
										if($endDate >= $today){//daca este inca valabil codul
											 echo'<option value="'.$codVoucher.'">'.$procent.'% '.$codVoucher.' : '.strftime("%e %b %Y",strtotime($startDate)).' - '.strftime("%e %b %Y",strtotime($endDate)).'</option>';
										}
										else{
											 echo'<option value="'.$codVoucher.'">'.$procent.'% '.$codVoucher.' : '.strftime("%e %b %Y",strtotime($startDate)).' - '.strftime("%e %b %Y",strtotime($endDate)).'<br> Puteti folosi acest cod doar daca data programarii ramane '.$dataProg.'.</option>';
										
										}
										
										}
									echo'</select>';
								}
					/* } */
					?>
							
						  </div>
						  
						  <button class="smallButton" name="submit" type="submit">Genereaza pret</button>
						  <br><br>
						</form> 
						<!--verificari pt formular-->
			<?php
						if (isset($_POST['submit'])) {
							
							$idProg=$_GET['idProg'];																																																																																
							$mailUser=$_GET['mailUser'];
							echo '<br>ID Programare: '.$idProg.'<br>';
							
							if(exista_programare($mailUser,$idProg) && status_progr($idProg) != "Finalizata"){
							//	echo '<br>Programarea exista si nu e finalizata deja';
								$status = status_progr($idProg);
								//echo '<br>statusul: '.$status;
								$dataProg_c=get_dataProgr_by_idProg($idProg);
								//echo '<br>dataProg_c:'.$dataProg_c;
									//echo '$_POST['dataProgr']:'.$_POST['dataProgr'].'.';
									
								
									if($dataProg_c == $_POST['dataProgr']){ //daca utilizatorul nu schimba data, atunci si angajatul ramane acelasi
										$dataProg= $dataProg_c ;
										$idAng=get_idAng_by_idProg($idProg);
										//echo 'Data '.$dataProg_c.' ramane '.$dataProg.'<br>';
									}
									else{
											if($dataProg_c != $_POST['dataProgr']){
												//echo '<br>Reprogramati pentru data: '.$_POST['dataProgr'].'<br>';
												//daca a schimbat data programarii, trebuie sa verificam sa fie disponibil un angajat pentru noua data
											
													if(check_available_employee2($_POST['dataProgr']) != false){
														$idAng=check_available_employee2($_POST['dataProgr']);
														$dataProg = $_POST['dataProgr'];
														//daca data e ok, continuam sa verificam codVoucher
														/*echo 'id Angajat disponibil: '.$idAng.'<br>';
														echo'<br>Data: '.$_POST['dataProgr'].'<br>';*/
													}
													else{
														echo 'Data aleasa nu este disponibila. Va rugam sa alegeti alta zi. <br>';
													}
												}
											}
										
								
									
									/*
									if ($_POST['voucherChoice'] != 'noVoucher'){ //daca a fost introdus cod voucher
										$voucherChoice=$_POST['voucherChoice'];
										
										$sql2 ="SELECT procent FROM coduripromo WHERE codVoucher = '$voucherChoice'";
										$result2= $conn->query($sql2);
										$row2= $result2-> fetch_assoc();
										
										$procent=$row2['procent'];
										
										
									}
									*/
									$codVoucher=$_POST['voucherChoice'];
										if ($codVoucher != "noVoucher"){ //daca a fost ales un codVoucher de client
											
											//if (disp_voucher($mailUser,$_POST['codVoucher'])== "disponibil" || $idProg == get_idProgr_by_voucherFol($mailUser,$_POST['codVoucher'])){
											if ($idProg == get_idProgr_by_voucherFol($mailUser,$codVoucher)){
												/*daca vouch e folosit pt progr pe care o editam acum
												 function get_idProgr_by_voucherFol($email,$codVoucher){
													cautam in programari intregistrarea cu email=$email si codVoucher=$_POST['codVoucher']
													return $idProg */
													
													//daca am ajuns aici, atunci evident codul este disponibil, iar la final ii aplicam reducere
													//$codVoucher=$_POST['voucherChoice'];
													echo 'vouch e folosit pt progr pe care o editam acum<br>';
														if($endDate >= $today){//daca este inca valabil codul
															echo' inca e valabil codul, e ok data '.$_POST['dataProgr'].'<br>';
															echo '<br>Reprogramati pentru data: '.$_POST['dataProgr'].'<br>';
															$dataProg=$_POST['dataProgr'];
															}
														else{
														//	 echo'Codul mai este valabil doar pt data care e deja programata';
															
															
															 if($dataProg_c == $_POST['dataProgr']){ //daca utilizatorul nu schimba data
															  echo 'e ok, nu a schimbat data<br>';
																$dataProg=$dataProg_c;
																  echo 'Data: '.$dataProg.'<br><br>';
																   echo 'Folositi codul: '.$codVoucher.'<br><br>';
															 }
															 else{
																 //echo 'Nu e ok, trebuie folosita aceeasi data';
																  echo 'Pentru a putea folosi codul '.$codVoucher.', data trebuie sa ramana '.$dataProg_c.'.<br><br> 
																  Daca doriti sa reprogramati pentru '.$_POST['dataProgr'].', va rugam sa alegeti alt cod promotional, daca este disponibil,<br> 
																  sau sa lasati campul <b> Cod Promotional </b> liber.<br><br>';
																  echo 'Folositi codul: '.$codVoucher.'<br>';
																  echo 'Data: '.$dataProg_c.'<br><br>';
																  $dataProg=$dataProg_c;
															 }
														}
													//echo 'Codul '.$codVoucher.'este acceptat.<br>';
												}
												else{
													//echo'Codul promotional '.$_POST['codVoucher'].' nu este acceptat!<br>';
													echo 'Am folosit alt cod disponibil, nu cel care era deja folosit, deci data poate ramane cea introdusa de client<br>';
													//nu e nevoie sa verificam daca este sau nu valabil codul, pt ca daca nu era valabil nu aparea in dropdownlist
													 $dataProg=$_POST['dataProgr'];
													echo '<br>Reprogramati pentru data: '.$_POST['dataProgr'].'<br><br>';
													 echo 'Folositi codul: '.$codVoucher.'<br><br>';
													 
													
													// si pretul ramane intreg
													//$codVoucher="";
												}
										}
										else{
											if($dataProg_c != $_POST['dataProgr'] ){
											echo 'Reprogramati pentru data '.$_POST['dataProgr'].'<br><br>';
												$dataProg = $_POST['dataProgr'];
											}
											else{
												echo '<br>Data '.$dataProg.' ramane '.$dataProg_c.'<br><br>';
												$dataProg = $dataProg_c;
											}
										}
										
									
									//continuam cu calcularea pretului dupa servicii.
									$pretTot=0;
									//echo '<br>Ati ales urmatoarele servicii:<br>';
									$listServ="";
									foreach($_POST as $key => $value){
										if ( $key != 'idProg' && $key != 'dataProgr' && $key != 'voucherChoice' && $key != 'submit'){
											$idServ=$value;
											$numeServ=get_numeServ_by_idServ($idServ);
											echo '-'.$numeServ . '<br>';
											//cream listaServ cu serviciile alese de client pentru a o trimite mai departe cand finalizam comanda
											if($listServ==""){
												$listServ=$listServ.$numeServ;
											}
											else{
													$listServ=$listServ.", ".$numeServ;
											}
											if($tipChoice != 0){
												$sql = "SELECT pretServ FROM pretServ where idServ = '$idServ' and idTip='$tipChoice'";   
											}
											else{
													$sql = "SELECT pretServ FROM servicii where idServ = '$idServ' ";
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
									echo '<br>Pret: '.$pretTot.' RON <br>';
									if ($codVoucher != "noVoucher"){ //daca a fost introdus cod voucher 
										$procent=get_procent_by_codVoucher($codVoucher);
										$pretFinal=$pretTot-($procent/100*$pretTot);
										echo 'Reducere din codul promotional '.$codVoucher.':'.($procent/100*$pretTot).' RON <br>';
										echo 'Pret estimativ: '.$pretFinal.' RON <br><br>';
										//$codVoucher=$_POST['codVoucher'];
										}
										else{//daca nu e valabil
											//$codVoucher = NULL;
											$pretFinal=$pretTot;
											//echo '<br>Pret final: '.$pretFinal.' RON <br>';
										}
									}
							}
						else {
								if (exista_programare($mailUser,$idProg) == false){
									echo 'Nu exista programarea cu id-ul '.$idProg.'.<br>';
								}
								else{
									if(status_progr($idProg) == "Finalizata")
										echo 'Programarea cu id-ul '.$idProg.' este deja finalizata, nu se poate modifica.<br>';
										
								}
							}
				
				if ($pretTot==0){
					echo'Nu se poate crea o programare care sa nu contina nici un serviciu.';
				}else{		
					echo '<a class="smallButton" href="updateProgrProcess.php?mailUser='.$mailUser.'&idProg='.$idProg.'&dataProg='.$dataProg.'&idAng='.$idAng.'&listServ='.$listServ.'&codVoucher='.$codVoucher.'&pretFinal='.$pretFinal.'&statusProg='.$statusProg.'">Salveaza schimbarile</a>';
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
		