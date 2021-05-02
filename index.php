<!DOCTYPE HTML>

<html>
	<head>
		<link rel="stylesheet"href="homeCSS.css">
		<link rel="stylesheet"href="prevAndTopBCSS.css">

		<title>Detailing Auto</title>
		
	</head>
	<body>
	
		<?php
		$mailUser='0';
		?>
	<div class="topbar">
			
			<div class="tbl"> <!-- tbl - top bar left-->
				<a href="logIn.php?mailUser=<?php echo $mailUser ?>">Contul Meu</a>
				<a href="signIn.php?mailUser=<?php echo $mailUser ?>">Mă Înregistrez</a>
				
			</div> <!--inch div lb-->
			
			<div class="tbr"> <!--  tbl - top bar right-->
				<a href="aboutUs.php?mailUser=<?php echo $mailUser ?>">Despre noi</a>
				<a href="galerieF2.php?mailUser=<?php echo $mailUser ?>">Galerie</a>
				<a href="aboutServices.php?mailUser=<?php echo $mailUser ?>" >Servicii oferite</a>
				<a href="reviews.php?mailUser=<?php echo $mailUser ?>">Reviews </a>
				<!--<a href="index.php?linkTarget=preturi" >Contact</a> -->
				
			</div> <!--inch div lb-->
			
	</div> <!--inch div topbar-->
	
		<div class="titluC">
			Detailing Auto
		</div> <!--inch div titlu-->
		
		<div class="boxL">
			chenar cu imagini
		</div>
			<!--
			<div class="boxR">
			 In dreapta fa-ti o programare
			</div>
			-->
		
	</body>
</html>
		
