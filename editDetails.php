<!DOCTYPE HTML>
<html>
	<head>
			<link rel="stylesheet"href="buttonsCSS.css">

		<link rel="stylesheet"href="editDetailsCSS.css">
		<link rel="stylesheet"href="prevAndTopBCSS.css">
		<title>Editare detalii</title>
	</head>
	<body>
	<?php
	include "db_connect.php";    /*c - curent;   n- nou */
	include "functions2.php";
	$email=$_GET['email'];
	$mailUser=$_GET['mailUser'];
	
	$token=getToken($email);
	$tokenUser=getToken($mailUser); //pt a sti pe ce pagina sa ne intoarcem
	
	if ($tokenUser == 1&& $token==1){
		//token == 1  -> cont sef
		echo'<a href="adminAccount.php?mailUser='.$mailUser.'" class="previous">&laquo; Inapoi</a>';
	}
	else if( $tokenUser == 1 && $token==0 ){
		echo'<a href="gestContAng.php?mailUser='.$mailUser.'" class="previous">&laquo; Inapoi</a>';

	}
	else if($tokenUser == 0){
		//token == 0  -> cont angajat
		echo'<a href="angAccount.php?mailUser='.$mailUser.'" class="previous">&laquo; Inapoi</a>';
		}
		else{ //ramane token == -1  -> cont client
		echo'<a href="myAccount.php?mailUser='.$mailUser.'" class="previous">&laquo; Inapoi</a>';
	
		}
	
	
	
	if ($token == 1 or $token == 0){
		//seful(tk=1) si angajatii(tk=0) au datele in acelasi tabel
		$sql = "SELECT numeAng, nrTelAng, dataNaAng FROM angajat WHERE mailAng ='$email'";
		$result= $conn->query($sql);
		$row = $result->fetch_assoc();
		
		$nume= $row["numeAng"];
		$nrTel= $row["nrTelAng"];
		$dataNa= $row["dataNaAng"];
	}
	else{
		if ($token == -1){
			//echo $email.' ,you are now logged in as client '.$token.'<br>';
			$sql = "SELECT numeCl, nrTelCl, dataNaCl FROM client WHERE mailCl ='$email'";
			$result= $conn->query($sql);
			$row = $result->fetch_assoc();
			
			$nume= $row["numeCl"];
			$nrTel= $row["nrTelCl"];
			$dataNa= $row["dataNaCl"];
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
	<h2>Editare detalii</h2>
	
		<?php 
		echo '<b>Nume curent:'.$nume.'</b><br>';
		echo '<a class="smallButton" href="editNume.php?email='.$email.'&mailUser='.$mailUser.'">Editare nume</a><br><br>';
		echo '<b>Numar de telefon curent:'.$nrTel.'</b><br>';
		echo '<a class="smallButton" href="editNrTel.php?email='.$email.'&mailUser='.$mailUser.'">Editare numar de telefon</a><br><br>';
		echo '<a class="smallButton" href="schimbareParola.php?email='.$email.'&mailUser='.$mailUser.'">Schimbare parola</a>';
		
		?>
		
		
	</div>
	
	</body>
</html>
		
