<!DOCTYPE HTML>
<html>
	<head>
	
		<link rel="stylesheet"href="prevAndTopBCSS.css">
		<link rel="stylesheet"href="editNumeCSS.css">
		<link rel="stylesheet"href="buttonsCSS.css">
		<title>Schimbare parola</title>
	</head>
	<body>
	<?php
	include "db_connect.php";    /*c - curent;   n- nou */
	include "functions2.php";
	$email=$_GET['email'];
	$mailUser=$_GET['mailUser'];
	$token=getToken($email);
	$token_user=getToken($mailUser); //pt a sti pe ce pagina sa ne intoarcem
		
	if ($tokenUser == 1){
		//token == 1  -> cont sed
		echo'<a href="editDetails.php?email='.$email.'&mailUser='.$mailUser.'" class="previous">&laquo; Inapoi</a>';
	}
	else if($token_user == 0){
		//token == 0  -> cont angajat
		echo'<a href="editDetails.php?email='.$email.'&mailUser='.$mailUser.'" class="previous">&laquo; Inapoi</a>';
		}
		else{ //ramane token == -1  -> cont client
		echo'<a href="editDetails.php?email='.$email.'&mailUser='.$mailUser.'" class="previous">&laquo; Inapoi</a>';
	
		}
	
	
	echo' <div id="topbarid" class="topbar">
		<div id="tblid" class="tbl"> ';
			echo'<a href="index.php"> Deconecteaza-te </a>';
		echo'</div>
		<div id="tbrid" class="tbr">';
			if ($tokenUser == 1&& $token==1){
			//token == 1  -> cont sef
				echo'<a href="adminAccount.php?mailUser='.$mailUser.'">Acasa</a>';
			}
			else 
				if( $tokenUser == 1 && $token==0 ){
					echo'<a href="adminAccount.php?mailUser='.$mailUser.'">Acasa</a>';
				}
				else
					if($tokenUser == 0){
				//token == 0  -> cont angajat
						echo'<a href="angAccount.php?mailUser='.$mailUser.'">Acasa</a>';
					}
					else{ //ramane token == -1  -> cont client
						echo'<a href="myAccount.php?mailUser='.$mailUser.'">Acasa</a>';
					}
			echo'<a href="galerieF2.php?mailUser='.$mailUser.'">Galerie</a>';
			echo'<a href="aboutUs.php?mailUser='.$mailUser.'"> Despre Noi</a>';
			echo'<a href="aboutServices.php?mailUser='.$mailUser.'"> Servicii Oferite </a>';
			echo'<a href="reviews.php?mailUser='.$mailUser.'"> Reviews </a>';
		echo'</div>
	</div>';
	?>
	
	
	
	
	<div class="editContainer">
	<form name="passChangeForm" onsubmit="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">   <!--  -->
		<h2>Schimbare parola</h2>
		<div class="dataEdit"> 
			<?php if($token == $token_user){ //cineva isi schimba parola lui
			//daca seful schimba parola unui angajat, atunci seful nu introduce parola curenta
			echo '<label for="par_c"><b>Parola curenta:</b></label>
			<input id="par_c" name="par_c" type="password" placeholder="******" maxlength="30" minlength="6" required>
			<br>  ';
			}
			?>
			<label for="par_n"><b>Parola noua:</b></label>
			<input id="par_n" name="par_n" type="password" placeholder="******" maxlength="30" minlength="6" required>
			<br>
			<label for="confpar_n"><b>Confirmare parola noua:</b></label>
			<input id="confpar_n" name="confpar_n" type="password" placeholder="******" maxlength="30" minlength="6" required>
		</div>
		<button  class="smallButton" name="pressEdit" type="submit">Schimba parola</button>
	</form> 
	
	<?php
		if (isset($_POST['pressEdit'])) {
			if ($token == $token_user){ //cineva isi schimba parola lui
				$par_c =$_POST['par_c'];
				$par_n = $_POST['par_n'];
				$confpar_n = $_POST['confpar_n'];
			
				if (correct_password($email,$par_c) && identical_passwords($par_n,$confpar_n) ){
					//echo "parola curenta e corect + parola noua e confirmata";
					include "schimbareParolaProcess.php";
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
			}
			else{ //daca seful schimba parola unui angajat
				$par_n = $_POST['par_n'];
				$confpar_n = $_POST['confpar_n'];
				if (identical_passwords($par_n,$confpar_n) ){
					include "schimbareParolaProcess.php";
					header("Location:gestContAng.php?mailUser=$mailUser");
				}
				else{
					echo 'Parolele nu sunt identice';
				}
			}
			
		}
	?>
	</div>
	</body>
</html>
		
