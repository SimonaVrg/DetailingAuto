<!DOCTYPE HTML>

<html>
	<head>
		<link rel="stylesheet"href="addServiciuCSS.css">
		<link rel="stylesheet"href="prevAndTopBCSS.css">
		<link rel="stylesheet"href="buttonsCSS.css">
		
		<title>Adaugare Serviciu Nou</title>
		
	</head>
	<body>
	
	<?php
	$mailUser=$_GET['mailUser'];
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
	<h2>Adaugare serviciu</h2>
	</div>
	
	<div class="addContainer">
		<form name="addServForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF?mailUser=$mailUser"]);?>" method="POST">   <!--  -->
		  <h2>Adauga un nou serviciu</h2>
		  <div class=signIn>
			  <label for="numeServ"><b>Nume:</b></label>
			  <input id="numeServ" name="numeServ" type="text" placeholder="Nume Serviciu" required>
			  <br>
			 
			  <label for="pret"><b>Pret:</b></label>
			  <input id="pret" name="pret" type="number" min="1" max="1000" placeholder="RON" required>
			  <br>
			  
			  <br>
		  </div>
		  <button class="smallButton" name="submit" type="submit">Adauga Serviciu</button>
		</form> 
	</div>
	<?php
	
		if (isset($_POST['submit'])) {
			include "db_connect.php";
			include "functions2.php";
			$mailUser=$_GET['mailUser'];
			//echo 'mailUser:'.$mailUser.'.<br>';
			$numeServ = $_POST['numeServ'];
			$pret = $_POST['pret'];
			
			if(serviciu_inDB($numeServ)==false){
				add_serv_inDB($numeServ,$pret); //adauga pretul standard
				$idServ=get_idServ_by_numeServ($numeServ);
				add_serv_pretserv($idServ);//adauga pt toate tipurile de caroserii pretul 0 in tabelul pretserv
				header("Location:gestPretServ.php?mailUser=$mailUser");
			}else{
				echo 'Deja exista serviciul cu numele: '.$numeServ.'<br>';
			}
			
		}
		
	?>
	</body>
</html>
		