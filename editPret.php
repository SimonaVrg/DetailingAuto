<!DOCTYPE HTML>

<html>
	<head>
		<link rel="stylesheet"href="editServiciuCSS.css">
		<link rel="stylesheet"href="prevAndTopBCSS.css">
		<link rel="stylesheet"href="buttonsCSS.css">
		
		<title>Schimbare pret</title>
		
	</head>
	<body>
		<?php
		include "db_connect.php";
		include "functions2.php";
		$mailUser=$_GET['mailUser']; 
		$idServ = $_GET['idServ'];
		if($_GET['idTip']){
			$idTip = $_GET['idTip'];
		}
		
		echo'<a href="gestPretServ.php?mailUser='.$mailUser.'" class="previous">&laquo; Inapoi</a>'; 
	

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
	<h2>Schimba pretul</h2>
	</div>
	
	<div class="editContainer">
	
		<form name="addServForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF?mailUser=$mailUser&numeServ=$numeServ"]);?>" method="POST">   <!--  -->
		  
		  <div class=signIn>
				<b><br>Nume:</b>
				<?php 
					$numeServ= get_numeServ_by_idServ($idServ);
					echo $numeServ;
					
					if($_GET['idTip']){
						$idTip = $_GET['idTip'];
						$tipCaroserieName=get_tipCaroserieNameByID($idTip);
						echo '<br><b>Tip caroserie: </b>'.$tipCaroserieName;
						$pretServ=get_pret_by_idServ_tipCaroserie($idServ,$idTip);
					}else{
						//daca nu primeste $_GET['idTip'], inseamna ca schimba pretul standard
						$pretServ= get_pretStandard_by_idServ($idServ);
					}
					
				
				?>
			  <label for="pret"><b><br>Pret:</b></label>
					<input id="pret" name="pret" type="number" value="<?php echo $pretServ;?>" min="0" max="1000" placeholder="RON" required>
			  <br>
			  
			  <br>
		  </div>
		  <button class="smallButton" name="submit" type="submit">Schimba pret</button>
		</form> 
	<?php
	
		if (isset($_POST['submit'])) {
			/*include "db_connect.php";
			include "functions2.php";*/
			$mailUser=$_GET['mailUser'];
			
			$idServ = $_GET['idServ'];
			$pret = $_POST['pret'];
			/*
			echo 'mailUser:'.$mailUser.'.<br>';
			echo 'idServ:'.$idServ.'.<br>';
			
			
			echo 'pretServ:'.$pret.'<br>';
			*/
			if($_GET['idTip']){
				$idTip = $_GET['idTip'];
				
				update_pret_pretserv($idServ,$idTip,$pret);
				header("Location:vizPretDet.php?mailUser=$mailUser&idServ=$idServ");
			}else{
				//daca nu primeste $_GET['idTip'], inseamna ca schimba pretul standard
				update_pret_servicii($idServ,$pret);
				header("Location:gestPretServ.php?mailUser=$mailUser");
			}
			
		
			
			
			
		}
		
	?>
	</div>
	</body>
</html>
		