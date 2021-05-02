<!DOCTYPE HTML>

<html>
	<head>
		<link rel="stylesheet"href="editServiciuCSS.css">
		<link rel="stylesheet"href="prevAndTopBCSS.css">
		<link rel="stylesheet"href="buttonsCSS.css">
		
		<title>Schimbare nume</title>
		
	</head>
	<body>
		<?php
		include "db_connect.php";
		include "functions2.php";
		$mailUser=$_GET['mailUser']; 
		
		if($_GET['idTip']){
			$idTip = $_GET['idTip'];
		}
		
		if($_GET['idMasina']){
			$idMasina = $_GET['idMasina'];
		}
		
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
	?>
	
	<div class="titlu">
		<h2>Schimba nume</h2>
	</div>
	
	<div class="editContainer">
	
		<form name="addServForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF?mailUser=$mailUser&numeServ=$numeServ"]);?>" method="POST">   <!--  -->
		  
		 
				<?php 
					if($_GET['idTip']){
						
						$nume = get_tipCaroserieNameByID($idTip);
						echo '<b><br>'.$nume.'</b><br>';
					}
					
					if($_GET['idMasina']){
					
						$marca = get_marcaMasinaByID($idMasina);
						$model = get_modelMasinaByID($idMasina);
					}
					
					
			if($_GET['idTip']){
				//daca modificamnumele unui tip de caroserie,e de ajuns un singur input
				?>
			  <label for="nume"><br>Schimba numele in:</label>
					<input id="nume" name="nume" type="text" value="<?php echo $nume;?>"  placeholder="<?php echo $nume;?>" required>
			  <?php
			}
			if($_GET['idMasina']){
				//daca modificam numele unei masini, vrem sa modificam numele marcii si numele modelului separat
			  ?>
				<label for="marca"><b><br>Marca:</b></label>
					<input id="marca" name="marca" type="text" value="<?php echo $marca;?>" placeholder="<?php echo $marca;?>" required>
				<label for="model"><b><br>Model:</b></label>
					<input id="model" name="model" type="text" value="<?php echo $model;?>"  placeholder="<?php echo $model;?>" required>
			 
			  
			 <?php
			}
			 ?>
			  <br>
			  
			  <br>
		 
		  <button class="smallButton" name="submit" type="submit">Schimba nume</button>
		</form> 
	<?php
	
		if (isset($_POST['submit'])) {
			
			if($_GET['idTip']){
				$nume = $_POST['nume'];
				
				update_nume_tipCaroserie($idTip,$nume);
				header("Location:gestMasini.php?mailUser=$mailUser");
			}
			
			if($_GET['idMasina']){
				$marca = $_POST['marca'];
				$model = $_POST['model'];
				echo'idMasina:'.$idMasina;
				echo 'marca noua:'.$marca.'<br>';
				echo 'model nou:'.$model.'<br>';
				update_marca_model_masini($idMasina,$marca,$model);
				header("Location:gestMasini.php?mailUser=$mailUser");
			}
		
			
			
			
		}
		
	?>
	</div>
	</body>
</html>
		