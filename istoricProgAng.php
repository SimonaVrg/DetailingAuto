<!DOCTYPE HTML>

<html>
	<head>
		<link rel="stylesheet"href="istoricProgAngCSS.css">
		<link rel="stylesheet"href="prevAndTopBCSS.css">
		<title>Istoric Programari</title>
		
	</head>
	<body>
	
	
	<?php
		include "db_connect.php";
		
		$mailUser=$_GET['mailUser'];
		
		$sql = "SELECT idAng FROM angajat WHERE mailAng ='$mailUser'";
		$result= $conn->query($sql);
		$row = $result->fetch_assoc();
		$idAng=$row["idAng"];
		

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
	?>
	
	<?php
		echo'<a href="vizProgrAng.php?mailUser='.$mailUser.'" class="previous">&laquo; Inapoi</a>'
	?>
	
	<div class="titlu">
	<h2> Istoric Programari </h2>
	</div>
	<?php
	
		//Vizualizare programari angajat
		$sql2 = "SELECT idProg, idCl, dataProg, listaServicii, pretProg, codVoucher, statusProg FROM programare WHERE idAng = '$idAng' ORDER BY idProg DESC";
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
						$statusProg= $row["statusProg"];
						if( $dataProg <= date('Y-m-d')){
							echo'<div class="'.$statusProg.'">';
							
								if($statusProg != 'Finalizata' and $statusProg != 'Anulata' ){
									echo'<div class="finProg">';
										echo '<a href="finProg.php?mailUser='.$mailUser.'&idProg='.$idProg.'&idCl='.$idCl.'&codVoucher='.$codVoucher.'">Finalizeaza comanda</a>';
									echo'</div>';
								}
								
								echo 'ID programare: '.$idProg.' <br>';
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
			  echo "Nu exista programari in istoricul tau momentan!";
			  echo'</div>';
			 
			}
		?>

	</body>
</html>
		