<!DOCTYPE HTML>
<html>
	<head>
		<link rel="stylesheet"href="logInCSS.css">
		<link rel="stylesheet"href="prevAndTopBCSS.css">
		<link rel="stylesheet"href="buttonsCSS.css">
		
		<title>Conecteaza-te</title>
		
	</head>
	<body>
	
	<?php
		$mailUser=$_GET['mailUser']; 
		echo'<a href="index.php?mailUser='.$mailUser.'" class="previous">&laquo; Inapoi</a>'; 
		?>
		
	<?php
	echo' <div id="topbarid" class="topbar">
		<div id="tblid" class="tbl"> ';
			echo'<a href="signIn.php?mailUser='.$mailUser.'"> Ma inregistrez </a>';
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
	<div class="logInForm">
	<form name="logInForm" onsubmit="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST"   >   <!--  -->
		<h2>Conecteaza-te</h2>
		<div class=logIn>
			<label for="mailUser"><b>E-mail:</b></label>
			<input id="mailUser" name="mailUser" type="email" placeholder="address@yahoo.com" pattern="[a-z]\w{1,}(\.|_){0,1}\w{1,}(@yahoo.com|@yahoo.it|@gmail.com)" required>
			<br>
		  
			<label for="parola"><b>Parola:</b></label>
			<input id="parola" name="parola" type="password" placeholder="******" maxlength="30" required>
			<br>
		</div>
		<button class="smallButton" name="presslogIn" type="submit">Conecteaza-te</button>
	</form> 
	
	<?php
	
		if(isset($_POST['presslogIn'])){
			//echo "Am apasat press login";
			include "functions2.php";
			include "db_connect.php";
			$mailUser = $_POST['mailUser'];
			$parola = $_POST['parola'];
			
			if (logInValidate($mailUser,$parola)){
				//in baza de date undeva exista combinatia de mail+parola; pe baza $email aflam token ca sa aflam daca e angajat, sef sau client
				$token=getToken($mailUser);
				if ($token == 1){
					//echo $email.' ,you are now logged in as Admin '.$token.'<br>';
					
					header("Location:adminAccount.php?mailUser=$mailUser");
				}
				else if ($token == 0){
					//echo $email.' ,you are now logged in as employee '.$token.'<br>';
					header("Location:angAccount.php?mailUser=$mailUser");
				}
				else{
					if ($token == -1){
						//echo $email.' ,you are now logged in as client '.$token.'<br>';
					
						header("Location:myAccount.php?mailUser=$mailUser");
					}
				}
			}
			else{
				echo '<br>';
				if(!email_inDB($mailUser))
					echo 'Nu exista un cont cu aceasta adresa de e-mail!';
				else
					if(!correct_password($mailUser,$parola))
						echo 'Parola introdusa este gresita!';
			}
		}
	?>
	</div>
	</div>
	</body>
</html>
		
