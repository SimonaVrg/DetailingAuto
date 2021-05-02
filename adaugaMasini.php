<!DOCTYPE HTML>

<html>
	<head>
		<link rel="stylesheet"href="editServiciuCSS.css">
		<link rel="stylesheet"href="prevAndTopBCSS.css">
		<link rel="stylesheet"href="buttonsCSS.css">
		
		
		<title>Adauga</title>
		
	</head>
	<body>
		<?php
		include "db_connect.php";
		include "functions2.php";
		$mailUser=$_GET['mailUser']; 
		
		echo'<a href="gestMasini.php?mailUser='.$mailUser.'" class="previous">&laquo; Inapoi</a>'; 
	

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
	if($_GET['add'] == "tipCaroserie" ){
			$titlu= "Adauga un nou tip de caroserie";
	}
	else{
		$titlu ="Adauga un nou model de masina";
	}
	
	echo'
	<div class="titlu">
	<h2>'.$titlu.'</h2>
	</div>';
	?>
	<div class="editContainer">
	
		<form name="addServForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF?mailUser=$mailUser"]);?>" method="POST">   <!--  -->
		  <?php echo'<h3>'.$titlu.'</h3>'; ?>
		  <div class=signIn>
				
				<?php 
					
			if($_GET['add'] == "tipCaroserie" ){
				//daca adaugam un tip de caroserie,e de ajuns un singur input
				?>
			  <label for="nume"><b>Nume tip caroserie:</b></label>
					<input id="nume" name="nume" type="text" placeholder="Nume Tip Caroserie" required>
			  <?php
			}
			else{
				//daca adaugan un model de masina, avem nevoie numele marcii si numele modelului separat
			  ?>
				<label for="marca"><b>Marca:</b></label>
					<input id="marca" name="marca" type="text" placeholder="Nume Marca" required>
				<label for="model"><b><br>Model:</b></label>
					<input id="model" name="model" type="text" placeholder="Nume Model" required>
			 
			  
			 <?php
			}
			 ?>
			  <br>
			  
			  <br>
		  </div>
		  <button class="smallButton" name="submit" type="submit">Adauga</button>
		</form> 
	<?php
	
		if (isset($_POST['submit'])) {
			
			if($_GET['add'] == "tipCaroserie" ){
				//add tip caroserie
				$nume = $_POST['nume'];
				add_tipCaroserie($nume);
				//update_nume_tipCaroserie($idTip,$nume);
				header("Location:gestMasini.php?mailUser=$mailUser");
			}
			else{
				$marca = $_POST['marca'];
				$model = $_POST['model'];
				
				add_marca_model($marca, $model);
				header("Location:gestMasini.php?mailUser=$mailUser");
			}
		
			
			
			
		}
		
	?>
	</div>
	</body>
</html>
		