<!DOCTYPE HTML>
<html>
	<head>
		
		<link rel="stylesheet"href="prevAndTopBCSS.css">
		<link rel="stylesheet"href="editNumeCSS.css">
		<link rel="stylesheet"href="buttonsCSS.css">
		<title>Editare nume</title>
	</head>
	<body>
	<?php
	include "db_connect.php";    /*c - curent;   n- nou */
	include "functions2.php";
	$email=$_GET['email'];
	$mailUser=$_GET['mailUser'];
	
	
	$tokenUser=getToken($mailUser); //pt a sti pe ce pagina sa ne intoarcem
	if ($tokenUser == 1){
		//token == 1  -> cont sed
		echo'<a href="editDetails.php?email='.$email.'&mailUser='.$mailUser.'" class="previous">&laquo; Inapoi</a>';
	}
	else if($tokenUser == 0){
		//token == 0  -> cont angajat
		echo'<a href="editDetails.php?email='.$email.'&mailUser='.$mailUser.'" class="previous">&laquo; Inapoi</a>';
		}
		else{ //ramane token == -1  -> cont client
		echo'<a href="editDetails.php?email='.$email.'&mailUser='.$mailUser.'" class="previous">&laquo; Inapoi</a>';
	
		}
	
	
	
	$token=getToken($email);
	if ($token == 1 or $token == 0){
		//seful(tk=1) si angajatii(tk=0) au datele in acelasi tabel
		$sql = "SELECT numeAng FROM angajat WHERE mailAng ='$email'";
		$result= $conn->query($sql);
		$row = $result->fetch_assoc();
		
		$nume= $row["numeAng"];
	}
	else{
		if ($token == -1){
			//echo $email.' ,you are now logged in as client '.$token.'<br>';
			$sql = "SELECT numeCl FROM client WHERE mailCl ='$email'";
			$result= $conn->query($sql);
			$row = $result->fetch_assoc();
			
			$nume= $row["numeCl"];
		}
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
	<form name="nameEditForm" onsubmit="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">   <!--  -->
		<h2>Editare nume</h2>
		<p><b>Nume curent: <?php echo $nume?> </b></p>
		<div class=dataEdit>
			<label for="nume_n"><b>Nume nou:</b></label>
			<input id="nume_n" name="nume_n" type="text" placeholder="nume" pattern="[A-Z][a-z]{1,15}[ ][A-Z][a-z]{1,15}"  required>
		</div>
		<button class="smallButton" name="pressEdit" type="submit">Salveaza</button>
	</form> 
	
	<?php
		if (isset($_POST['pressEdit'])) {
			$nume_n = $_POST['nume_n'];
			include "editNumeProcess.php";
			$token_user=getToken($mailUser);
			if ($token_user == 1){
					if($token!=$token_user){ //daca suntem logati cu cont de sef si schimbam numele unui angajat, nu ne mai trimite la pagina principala
						header("Location:gestContAng.php?mailUser=$mailUser");
					}
					else{
					//echo $email.' ,you are now logged in as Admin '.$token.'<br>';
					header("Location:adminAccount.php?mailUser=$mailUser");
					}
				}
				else if ($token_user == 0){
					//echo $email.' ,you are now logged in as employee '.$token.'<br>';
					header("Location:angAccount.php?mailUser=$mailUser");
				}
				else{
					if ($token_user == -1){
						//echo $email.' ,you are now logged in as client '.$token.'<br>';
						header("Location:myAccount.php?mailUser=$mailUser");
					}
				}

		}
	?>
	</div>
	
	</body>
</html>
		
