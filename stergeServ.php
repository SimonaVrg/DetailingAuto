<!DOCTYPE HTML>

<html>
	<head>
		<link rel="stylesheet"href="editServiciuCSS.css">
		<link rel="stylesheet"href="prevAndTopBCSS.css">
		<link rel="stylesheet"href="buttonsCSS.css">
		
		<title>Sterge Serviciu</title>
	</head>
	<body>
		<?php
		$mailUser=$_GET['mailUser']; 
		$idServ=$_GET['idServ'];
		$numeServ = $_GET['numeServ'];
		$pretServ = $_GET['pretServ'];
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
		<h2>Sterge un serviciu</h2>
		</div>
		<div class="editContainer">
			<form name="stergeServ" onsubmit="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">   <!--  -->
				<h3>Esti sigur ca vrei sa stergi acest serviciu?<br></h3>
				<p>Serviciul va ramane inclus in programarile existente, dar nu va mai fi disponibil pentru programarile viitoare.</p>
				<?php 
					//echo 'ID Serviciu: '.$idServ.' <br>';
					echo 'Nume: '.$numeServ.' <br>';
					echo 'Pret: '.$pretServ.' <br>';
				
				?>
				<button class="smallButton" name="pressSterge" type="submit">Da, sterge </button>
				<button class="smallButton" name="pressRenunta" type="submit">Nu, renunta</button>
			</form> 
		<?php
		if (isset($_POST['pressSterge'])) {
				echo 'Stergem serviciul cu id '.$idServ.'<br>';
				include"functions2.php";
				//include "stergeContAngProcess.php";
				 delete_serv($idServ);
				header("Location:gestPretServ.php?mailUser=$mailUser");
		}
		if (isset($_POST['pressRenunta'])) {
				echo 'Nu stergem serviciul<br>';
					header("Location:gestPretServ.php?mailUser=$mailUser");
		}
						
		?>
	
	</div>
	</body>
</html>
		