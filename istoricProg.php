<!DOCTYPE HTML>

<html>
	<head>
		<link rel="stylesheet"href="prevAndTopBCSS.css">
		
		<link rel="stylesheet"href="istoricProgCSS.css">
		<title>Istoric Programari</title>
		
	</head>
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
	
	
		echo'<a href="vizProgr.php?mailUser='.$mailUser.'" class="previous">&laquo; Inapoi</a>'
	?>
	
	<div class="titlu">
	<h2> Istoric Programari </h2>
	</div>
	<?php
	
		//Vizualizare programari client
		$today=date('Y-m-d');
		$sql2 = "SELECT idProg, idMasina, idAng, dataProg, listaServicii, pretProg, codVoucher, statusProg FROM programare WHERE idCl = '$idCl' && (dataProg<'$today' or (dataProg='$today' and statusProg='Finalizata')) && displayForClient != 'hide' ORDER BY dataProg DESC";
			$result= $conn->query($sql2);
			if ($result->num_rows > 0) {
			echo '<div class="gestProgr">';	  // inc div gestProgr
				
				echo'<div class="vizProgr">';
					
					
					while($row = $result->fetch_assoc()) {
						$idProg=$row["idProg"];
						$dataProg= $row["dataProg"];
						$idAng= $row["idAng"];
						$listaServ= $row["listaServicii"];
						$codVoucher= $row["codVoucher"];
						$pretProg= $row["pretProg"];
						$statusProg= $row["statusProg"];
						$idMasina= $row["idMasina"];
						
						if( $dataProg <= date('Y-m-d')){
							echo'<div class="'.$statusProg.'">';
							
								echo '<div class="deleteProg">';  //only change status to hidden instead of delete; we'll only delete an appointment that hasn't been finished
									echo '<form name ="form_update_displayForClient'.$idProg.'" method="POST"> 
										<input type="submit" name="update_displayForClient'.$idProg.'"
												value="Sterge din istoric"/> 
									</form> ';
									  if(isset($_POST['update_displayForClient'.$idProg.''])) { 
											//header("Location:deleteProg.php?idProg=$idProg&idCl=$idCl&mailUser=$mailUser&dataProg=$dataProg&codVoucher=$codVoucher&listServ=$listaServ&pretProg=$pretProg&idAng=$idAng");
											//echo 'This is update_displayForClient'.$idProg.' that is selected'; 
											set_displayForClient_hide($idProg);
											header("Location:istoricProg.php?mailUser=$mailUser"); //refresh la pagina pt a vedea ca am sters
											
										}
									//echo '<a href="deleteProg.php?idProg='.$idProg.'&idCl='.$idCl.'&mailUser='.$mailUser.'&dataProg='.$dataProg.'&codVoucher='.$codVoucher.'&listServ='.$listaServ.'&pretProg='.$pretProg.'&idAng='.$idAng.'">Sterge din istoric</a>';
								echo'</div>';
								
								echo 'ID programare: '.$idProg.' <br>';
								
								if($idMasina == 0){
									echo 'Nu ati ales un model de masina. <br>';
								}
								else{
									$carName=get_carNameByID($idMasina);
									echo 'Masina: '.$carName.' <br>';
								}
								
								echo 'Data programare: '.$dataProg.' <br>';
								echo 'Lista servicii alese: '.$listaServ.' <br>';
								if($codVoucher!=''){
								echo 'Cod voucher folosit: '.$codVoucher.' <br>';
								}
								echo 'Pret: '.$pretProg.' <br>';
								echo 'Status: '.$statusProg.' <br>';
								if($statusProg =='Anulata'){ 
								echo' Programarea a fost anulata.';
									 
								}
							echo'</div>';
						}
					}
				echo'</div>';
			
							
				
			echo '</div>'; //sf div gestProgr
			
		}
			else{
				echo'<div class="nuExProgr">';
			  echo "Nu exista programari in istoricul dumneavoastra momentan!";
			  echo'</div>';
			 
			}
		?>

	</body>
</html>
		