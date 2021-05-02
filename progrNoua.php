<!DOCTYPE HTML>

<html>

	<head>
	
	<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
	<meta charset="utf-8" />
	
		<link rel="stylesheet"href="buttonsCSS.css">
		<link rel="stylesheet"href="prevAndTopBCSS.css">
		<link rel="stylesheet"href="progrNouaCSS.css">
		
		<title>Creeaza o programare</title>
		
	</head>
	<body>
	
	
	<?php
	header('Content-Type: text/html; charset=utf-8');
	
	include "db_connect.php";
	include "functions2.php";
	
	$mailUser=$_GET['mailUser'];
	$carChoice=$_GET['carChoice'];
	$tipChoice=$_GET['tipChoice'];
	
	$today = date('Y-m-d');
	
	$maxdate = date_create($today);
	date_modify($maxdate, '+2 months');
	//echo date_format($maxdate, 'Y-m-d');
	
	$mindate = date_create($today);
	date_modify($mindate, '+ 2 days');
	//echo date_format($mindate, 'Y-m-d');
	
	
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
	
	
		
		echo'<a href="myAccount.php?mailUser='.$mailUser.'" class="previous">&laquo; Inapoi</a>';
		/*
		//afiseaza codurile promotionale intr-un chenar in partea dreapta
		if (exista_cod_voucher_pt_client($mailUser)){
			
			echo'<div class="codVoucher">';
				display_cod_voucher_pt_client($mailUser);
			echo '</div>'; //inch div codVoucher
		}
		*/
		?>
		
		
	
	
		<div class="createProgrForm">
		<h2>Creeaza o programare</h2>
		<?php
		if ($tipChoice != "otherChoice"){
			$carName=get_carNameByID($carChoice);
			$tipName=get_tipCaroserieNameByID($tipChoice);
			echo '<span style="font-size:20px;"><b>'.$carName.'</b></span>';
			echo '<br>';
			echo '<span style="font-size:20px;"><b>'.$tipName.'</b></span>';
		}
		?>
		<br><br>
		<form name="progrForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF?mailUser='.$mailUser.'"]);?>" method="POST">   <!--  -->
			<div class=progr>
			<?php
				echo'<select name="carChoice" hidden>';
					 echo'<option value="'.$carChoice.'" selected hidden></option>';
				echo'</select>';
				
				echo'<select name="tipChoice" hidden>';
					 echo'<option value="'.$tipChoice.'" selected hidden></option>';
				echo'</select>';
			?>
				<label for="dataProgr"><b>Data:</b></label>
				<input type="date" placeholder="mm/dd/yyyy" id="dataProgr" name="dataProgr" max="<?php echo date_format($maxdate, 'Y-m-d')?>"  min="<?php echo date_format($mindate, 'Y-m-d')?>" required>
				<br>
				
				<p><b>Servicii:</b></p>
				<?php
					include "db_connect.php";
									
					//$sql = "SELECT numeServ, pretServ FROM serviciu";
					//cautam serviciile disponibile pentru masina aleasa
					if($tipChoice != "otherChoice"){
						
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
							$numeServ=get_numeServ_by_idServ($idServ);
							echo'
								<input class="check" type="checkbox" name="serv'.$i.'" value="'.$idServ.'">
								<label class="nume" for="serv'.$i.'">'.$numeServ.' : '.$pretServ.' RON </label><br>';
							$i=$i+1;
						  }
					} else {
					  echo "Ne pare rau, momentan nu exista servicii disponibile.<br>";
					}
				?>
				<br>
				<!--
				<label for="codVoucher"><b>Cod Voucher:</b></label>
				<input id="codVoucher" name="codVoucher" type="text" placeholder="AX67FG" pattern="[A-Z]{2}[0-9]{2}[A-Z]{2}" >
				-->
				
					<?php
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
							
							if ($result->num_rows > 0) {
							echo '<b>Cod Promotional:</b>';
								echo'<select name="voucherChoice">';
									 echo'<option value="noVoucher"></option>'; /* in caz ca utilizatorul nu alege nici un codVoucher*/
									
								while($row = $result->fetch_assoc()) {
									echo $row['codVoucher'].'<br>';
									 echo'<option value="'.$row['codVoucher'].'">'.$row['procent'].'% '.$row['codVoucher'].' : '.strftime("%e %b %Y",strtotime($row[startDate])).' - '.strftime("%e %b %Y",strtotime($row[endDate])).'</option>';
									}
								echo'</select>';
							}
							else{
								echo'<select name="voucherChoice" hidden>';
									 echo'<option value="noVoucher" selected hidden></option>';
								echo'</select>';
							}
					?>
						
					 
					
			
		  </div>
		    <br>
		  <button class="smallButton" name="submit" type="submit">Genereaza pret</button>
		
		</form> 
	<?php
		include "db_connect.php";
		$mailUser=$_GET['mailUser'];
		if (isset($_POST['submit'])) {
		
				if(check_available_employee2($_POST['dataProgr']) != false){
					$idAng=check_available_employee2($_POST['dataProgr']);
					//echo 'id Angajat disponibil: '.$idAng.'<br>';
					echo'<br>Data: '.$_POST['dataProgr'].'<br>';
					/* de cand am pus dropdownlist, nu mai are cum sa nu fie acceptat codul
					codurilePromotionale care apar in dropdownlist sunt : 
					- valabile in functie de startDate si endDate
					- doar codurile nefolosite de client
					
					if ($_POST['codVoucher'] != ''){ //daca a fost introdus cod voucher
						if (disp_voucher($mailUser,$_POST['codVoucher'])=="disponibil"){
						//	echo'Codul promotional '.$_POST['codVoucher'].' valabil!<br>';
						}
						else{
							echo'Codul promotional '.$_POST['codVoucher'].' nu este acceptat!<br>';
						}
					}
					*/
					$pretTot=0;
					//echo '<br>Ati ales urmatoarele servicii:<br>';
					$listServ="";
					foreach($_POST as $key => $value){
						if ( $key != 'dataProgr' && $key != 'codVoucher' && $key != 'submit'&& $key != 'voucherChoice' && $key != 'procent' && $key != 'carChoice' && $key != 'tipChoice' ){
							$numeServ=get_numeServ_by_idServ($value);
							echo '-'.$numeServ . '<br>';
							//cream listaServ cu serviciile alese de client pentru a o trimite mai departe cand finalizam comanda
							if($listServ==""){ //aici punem virgula dupa fiecare serviciu din lista
								$listServ=$listServ.$numeServ;
							}
							else{
									$listServ=$listServ.", ".$numeServ;
							}
							if($tipChoice != "otherChoice"){
								$sql = "SELECT pretServ FROM pretServ where idServ = '$value' and idTip='$tipChoice'";   
							}
							else{
									$sql = "SELECT pretServ FROM servicii where idServ = '$value' ";
							}
							$result= $conn->query($sql);
							$row = $result->fetch_assoc();
							//echo 'pret: '.$row[pretServ].'<br>';
							$pretTot += $row["pretServ"];
							//echo 'pretTot: '.$pretTot.'<br>';
						}
					}
					if ($pretTot==0){
						echo'Nu se poate crea o programare care sa nu contina nici un serviciu.';
					}else
					{
						echo '<br>Pret total: '.$pretTot.' RON <br><br>';
						
						
						
						
						if ($_POST['voucherChoice']!="noVoucher"){ //daca a fost introdus cod voucher
							$voucherChoice=$_POST['voucherChoice'];
							$sql2 ="SELECT procent FROM coduripromo WHERE codVoucher = '$voucherChoice'";
							$result2= $conn->query($sql2);
							$row2= $result2-> fetch_assoc();
							
							$procent=$row2['procent'];
							
							/*
							nu mai trebuie sa verificam daca este valabil codul. Daca nu era valabil, userul nu avea optiunea sa il introduca din dropdownlist
							
							if (disp_voucher($mailUser,$_POST['codVoucher'])=="disponibil"){//daca e si valabil codul aplicam reducerea
								$pretFinal=$pretTot-(20/100*$pretTot);
								echo 'Reducere din codul promotional:'.(20/100*$pretTot).' RON <br>';
								echo 'Pret final: '.$pretFinal.' RON <br>';
								$codVoucher=$_POST['codVoucher'];
							}
							else{//daca nu e valabil
								$codVoucher='';
								$pretFinal=$pretTot; 
								
								
								//echo
							*/
								$pretFinal=$pretTot-($procent/100*$pretTot);
								echo 'Cod promotional folosit:'.$procent.'% '.$voucherChoice.'<br>';
								echo 'Reducere din codul promotional:'.($procent/100*$pretTot).' RON <br>';
								echo 'Pret final: '.$pretFinal.' RON <br>';
								
						}
						else{
							$pretFinal=$pretTot;
							//echo 'Pret final:'.$pretFinal.' RON<br><br>';
							echo 'Nu am ales nici un voucher';
						}
						
						$sql = "SELECT idCl FROM client WHERE mailCl ='$mailUser'";
						$result= $conn->query($sql);
						$row = $result->fetch_assoc();
						$idCl=$row["idCl"];
						
						$codVoucher=$_POST['voucherChoice'];
						echo '<br>carChoice: '.$carChoice;
						echo '<br>tipChoice: '.$tipChoice;
						echo '<a class="smallButton" href="addProgrProcess.php?idCl='.$idCl.'&mailUser='.$mailUser.'&dataProgr='.$_POST['dataProgr'].'&codVoucher='.$codVoucher.'&listServ='.$listServ.'&pretFinal='.$pretFinal.'&idAng='.$idAng.'&carChoice='.$carChoice.'&tipChoice='.$tipChoice.'">Finalizeaza programare</a>';
					
					
					//urmeaza sa mergem in addProgrProcess sa facem modificarile pentru coduripromo cand adaugam o programare noua 
					
					
					}
				}
				else{
					echo '<br> Programul pentru '.$dataProgr.' este full. Poti programa pentru alta zi';
				}
			
		}
	?>
	</div>
	</body>
</html>
		