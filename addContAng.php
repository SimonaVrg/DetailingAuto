<!DOCTYPE HTML>

<html>
	<head>
		<link rel="stylesheet"href="addContAngCSS.css">
		<link rel="stylesheet"href="buttonsCSS.css">
		<link rel="stylesheet"href="prevAndTopBCSS.css">
		
		<title>Adauga un nou angajat</title>
	</head>
	<body>
	
	<?php
	$mailUser=$_GET['mailUser'];
	echo'<a href="gestContAng.php?mailUser='.$mailUser.'" class="previous">&laquo; Inapoi</a>';
	
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
	
	<div class="addContainer">
		<form name="addContAngForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF?mailUser=$mailUser"]);?>" method="POST">   <!--  -->
		  <h2>Adauga un nou angajat</h2>
		  <div class=signIn>
			  <label for="numeAng"><b>Nume:</b></label>
			  <input id="numeAng" name="numeAng" type="text" placeholder="Nume Prenume" pattern="[A-Z][a-z]{1,15}[ ][A-Z][a-z]{1,15}"  required>
			  <br>
			  <label for="email"><b>E-mail:</b></label>
			  <input id="email" name="email" type="email" placeholder="address@yahoo.com" pattern="[a-z]\w{1,}(\.|_){0,1}\w{1,}(@yahoo.com|@yahoo.it|@gmail.com)" required>
			  <br>
			  <label for="nrTelAng"><b>Nr. de telefon:</b></label>
			  <input id="nrTelAng" name="nrTelAng" type="tel" placeholder="07********" pattern="07[0-9]{8}" required>
			  <br>
			  <label for="dataNaAng"><b>Data Nasterii:</b></label>
			  <input id="dataNaAng"  name="dataNaAng" type="date" placeholder="mm/dd/yyyy" max="2002-01-01"  min="1920-01-01" required>
			  <br>
			  <label for="parolaAng"><b>Parola:</b></label>
			  <input id="parolaAng" name="parolaAng" type="password" placeholder="******" maxlength="30" minlength="6" required>
			  <br>
			  <label for="confParAng"><b>Parola:</b></label>
			  <input id="confParAng" name="confParAng" type="password" placeholder="******" maxlength="30" minlength="6" required>
			  
			  <br><br>
		  </div>
		  
		  <button class="smallButton" name="submit" type="submit">Creeaza Cont</button>
		</form> 
	<?php
		if (isset($_POST['submit'])) {
			$mailUser=$_GET['mailUser'];
			
			include "functions2.php";
			//echo 'am apasat submit<br>';
			$numeAng = $_POST['numeAng'];
			$email = $_POST['email'];
			$nrTelAng = $_POST['nrTelAng'];
			$dataNaAng = $_POST['dataNaAng'];
			$parolaAng = $_POST['parolaAng'];
			$confParAng = $_POST['confParAng'];
			//echo 'email'.$email.'.<br>';
			
			if (email_inDB($email)==false && nrTel_inDB($nrTelAng)==false && identical_passwords($parolaAng,$confParAng)) {
				//echo 'E-mail and phone number do not exist in the database.<br>Passwords match<br> Its fine <br>';
				include "addContAngProcess.php";
				header("Location:gestContAng.php?mailUser=$mailUser");
				
			}
			if (email_inDB($email)==true){
				echo '<br><span style="color:red;"><b>Adresa de e-mail '.$email.' este deja folosita.</b></span><br>';
			}
			if (nrTel_inDB($nrTelAng)==true){
				echo 'Numarul '.$nrTelAng.' este deja folosit.<br> Nu pot exista doua conturi cu acelasi numar.<br>';
			}
			if (identical_passwords($parolaAng,$confParAng)== false){
				echo 'Parolele introduse nu sunt la fel.<br>';
			}
		}
	?>
	</div>
	</body>
</html>
		