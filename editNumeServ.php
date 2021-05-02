<!DOCTYPE HTML>

<html>
	<head>
		<link rel="stylesheet"href="editServiciuCSS.css">
		<link rel="stylesheet"href="prevAndTopBCSS.css">
		<link rel="stylesheet"href="buttonsCSS.css">
		<title>Editeaza numele unui serviciu</title>
		
	</head>
	<body>
		<?php
		$mailUser=$_GET['mailUser']; 
		$numeServ = $_GET['numeServ'];
		$idServ = $_GET['idServ'];
		
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
	<h2>Schimba nume serviciu</h2>
	</div>
		
	<div class="editContainer">
		<form name="addServForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF?mailUser=$mailUser&numeServ=$numeServ"]);?>" method="POST">   <!--  -->
		  
		  <div class=signIn>
				<br><b>Nume serviciu:</b>
				<?php 
					echo $numeServ;
				?>
			  <label for="nume_n"><b><br>Schimba numele in:</b></label>
			  <input id="nume_n" name="nume_n" type="text" value="<?php echo $numeServ;?>" min="10" max="1000" required>
			  <br>
			  
			  <br>
		  </div>
		  <button class="smallButton" name="submit" type="submit">Salveaza schimbarile</button>
		</form> 
	<?php
	
		if (isset($_POST['submit'])) {
			include "db_connect.php";
			include "functions2.php";
			$mailUser=$_GET['mailUser'];
			$nume_n = $_POST['nume_n'];
			
			
			echo 'mailUser:'.$mailUser.'.<br>';
			echo 'numeServ:'.$nume_n.'.<br>';
			
			update_nume_serv($numeServ,$nume_n);
			
			header("Location:gestPretServ.php?mailUser=$mailUser");
		}
		
	?>
	</div>
	</body>
</html>
		