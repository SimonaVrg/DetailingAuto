<!DOCTYPE HTML>

<html>
	<head>
		<link rel="stylesheet"href="addServiciuCSS.css">
		<link rel="stylesheet"href="prevAndTopBCSS.css">
		<title>Adaugare cod promotional</title>
		
	</head>
	<body>
		<?php 
		$mailUser=$_GET['mailUser']; 
		echo'<a href="gestPromotii.php?mailUser='.$mailUser.'" class="previous">&laquo; Inapoi</a>'; 
		
	
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
		<h2>Adauga un nou cod promotional</h2>
	</div>
	
	<div class="addContainer">
		<form name="addServForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF?mailUser=$mailUser"]);?>" method="POST">   <!--  -->
		 
		  <div class=signIn>
			  <label for="codVoucher"><b>Cod Promotional:</b></label>
				<input id="codVoucher" name="codVoucher" type="text" placeholder="AX67FG" pattern="[A-Z]{2}[0-9]{2}[A-Z]{2}" >
				<br>
			  <br>
		  </div>
		  <button name="submit" type="submit">Adauga Cod Promotional</button>
		</form> 
	

	<?php
		if (isset($_POST['submit'])) {
			include "db_connect.php";
			include "functions2.php";
			$mailUser=$_GET['mailUser'];
			$codVoucher = $_POST['codVoucher'];
			
			if(codVoucher_inDB($codVoucher)==false){
				add_codVoucher_inDB($codVoucher);
				header("Location:gestPromotii.php?mailUser=$mailUser");
			}else{
				echo 'Deja exista codul promotional: '.$codVoucher.'<br>';
			}
			
		}
		
	?>
	</div>
	</body>
</html>
		