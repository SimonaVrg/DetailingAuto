<!DOCTYPE HTML>
<html>
	<head>
		<link rel="stylesheet"href="signInCSS.css">
		<link rel="stylesheet"href="prevAndTopBCSS.css">
		<link rel="stylesheet"href="buttonsCSS.css">
		
		<title>Inregistreaza-te</title>
		
	</head>
	<body>
	
	<?php
		$mailUser=$_GET['mailUser']; 
		echo'<a href="index.php?mailUser='.$mailUser.'" class="previous">&laquo; Inapoi</a>'; 
		?>
		
	<?php
	echo' <div id="topbarid" class="topbar">
		<div id="tblid" class="tbl"> ';
			echo'<a href="logIn.php?mailUser='.$mailUser.'">Contul Meu</a>';
		echo'</div>
		<div id="tbrid" class="tbr">';
			echo'<a href="index.php">Acasa</a>';
			echo'<a href="galerieF2.php?mailUser='.$mailUser.'">Galerie</a>';
			echo'<a href="aboutUs.php?mailUser='.$mailUser.'"> Despre Noi</a>';
			echo'<a href="aboutServices.php?mailUser='.$mailUser.'"> Servicii Oferite </a>';
			echo'<a href="reviews.php?mailUser='.$mailUser.'"> Reviews </a>';
	echo'	</div>
	</div>';
	?>
	
	<div class="background">
		
		<div class="signInForm">
		<form name="signInForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">   <!--  -->
		  <h2>Inregistreaza-te</h2>
		  <div class=signIn>
			  <label for="numeCl"><b>Nume:</b></label>
			  <input id="numeCl" name="numeCl" type="text" placeholder="Nume Prenume" pattern="[A-Z][a-z]{1,15}[ ][A-Z][a-z]{1,15}"  required>
			  <br>
			  <label for="mailUser"><b>E-mail:</b></label>
			  <input id="mailUser" name="mailUser" type="email" placeholder="address@yahoo.com" pattern="[a-z]\w{1,}(\.|_){0,1}\w{1,}(@yahoo.com|@yahoo.it|@gmail.com)" required>
			  <br>
			  <label for="nrTelCl"><b>Numar de telefon:</b></label>
			  <input id="nrTelCl" name="nrTelCl" type="tel" placeholder="07********" pattern="07[0-9]{8}" required>
			  <br>
			  <label for="dataNaCl"><b>Data Nasterii:</b></label>
			  <input id="dataNaCl"  name="dataNaCl" type="date" placeholder="mm/dd/yyyy" max="2002-01-01"  min="1920-01-01" required>
			  <br>
			  <label for="parolaCl"><b>Parola:</b></label>
			  <input id="parolaCl" name="parolaCl" type="password" placeholder="******" maxlength="30" minlength="6" required>
			  <br>
			  <label for="confParCl"><b>Parola:</b></label>
			  <input id="confParCl" name="confParCl" type="password" placeholder="******" maxlength="30" minlength="6" required>
			  
			  <br>
		  </div>
		  
		  <button class="smallButton" name="submit" type="submit">Creeaza Cont</button>
		</form> 
	<?php
		if (isset($_POST['submit'])) {
			include "functions2.php";
			$numeCl = $_POST['numeCl'];
			$mailUser = $_POST['mailUser'];
			$nrTelCl = $_POST['nrTelCl'];
			$dataNaCl = $_POST['dataNaCl'];
			$parolaCl = $_POST['parolaCl'];
			$confParCl = $_POST['confParCl'];
			
			if (signInValidate($mailUser,$parolaCl,$confParCl)){
				//echo "signInValidate is TRUE";
				include "signInProcess.php";
				header("Location:myAccount.php?mailUser=$mailUser");

				//header("Location:index.php"); 
				//in loc de index.php punem pagina cu ceva gen
				//contul meu; tot acolo o sa ne duca si de la log in 
			}
			else{
				if (email_inDB($mailUser)){
				echo 'Deja exista un cont cu aceasta adresa de e-mail.<br>';
				}
				if (identical_passwords($parolaCl,$confParCl)==false){
					echo 'Parolele nu sunt identice.<br>';
				}
			}
		}
		
	?>
	</div>
	</div> <!-- inch div background -->
	</body>
</html>
		