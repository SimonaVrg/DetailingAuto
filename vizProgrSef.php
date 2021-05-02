<!DOCTYPE>
<html>
	<head>
		<link rel="stylesheet" href="vizProgrSefCSS.css">
		<link rel="stylesheet"href="prevAndTopBCSS.css">
		
		<title>Admin Account</title>
	</head>
	<body>
	<?php
	include "db_connect.php";
	include "functions2.php";
	$mailUser=$_GET['mailUser'];
	//echo 'mailUser: '.$mailUser.'<br>';
	echo'<a href="adminAccount.php?mailUser='.$mailUser.'" class="previous">&laquo; Inapoi</a>'; 
		
	
	$sql = "SELECT numeAng, nrTelAng, dataNaAng FROM angajat WHERE mailAng ='$mailUser'";
	$result= $conn->query($sql);
	$row = $result->fetch_assoc();
	
	$numeAng= $row["numeAng"];
	$nrTelAng= $row["nrTelAng"];
	$dataNaAng= $row["dataNaAng"];

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
	
	<div id="mainid" class="mainDiv">
		<div id="progrid" class="progr">
			<p><br><br></p>
			<form class="formButton" name="toateProgr" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF?mailUser='.$mailUser.'"]);?>" method="POST">   <!--  -->
				  <button class="buton" name="toateProgr" type="submit"> Vezi toate programarile</button>
			</form>
		<br>
			<form class="formButton" name="progrAcc" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF?mailUser='.$mailUser.'"]);?>" method="POST">   <!--  -->
				 <button class="buton" name="progrAcc" type="submit"> Vezi programarile acceptate</button>
			</form>
		<br>
			<form class="formButton" name="progrFin" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF?mailUser='.$mailUser.'"]);?>" method="POST">   <!--  -->
				 <button class="buton" name="progrFin" type="submit"> Vezi programarile finalizate</button>
			</form>
		<br>
			<form class="formButton" name="progrAnulate" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF?mailUser='.$mailUser.'"]);?>" method="POST">   <!--  -->
				 <button class="buton" name="progrAnulate" type="submit"> Vezi programarile anulate</button>
			</form>
			
			<!--
			<form name="progrCl" action="<?php //echo htmlspecialchars($_SERVER["PHP_SELF?mailUser='.$mailUser.'"]);?>" method="POST"> 
				 <!--<button class="buton" name="progrCl" type="submit"> Vezi programrile unui client</button>
			</form>
			-->
			
			<!-- 
			<form name="progrAng" action="<?php//echo htmlspecialchars($_SERVER["PHP_SELF?mailUser='.$mailUser.'"]);?>" method="POST">  
				 <button class="buton" name="progrAng" type="submit"> Vezi programarile unui angajat</button>
			</form>
			-->
			
		</div> 
		
		<div id="afisare" class="afisare">
			
			<div class="afProgr">
				<?php
					if (!isset($_POST['toateProgr']) && !isset($_POST['progrAcc']) && !isset($_POST['progrFin']) && !isset($_POST['progrAnulate']) ){
						echo'<p>Vezi toate programarile</p>';
						af_toate_progr(); //cand intram pe pagina, ne arata toate programarile
					}
					//echo "aici afisam programarile: ";
					if (isset($_POST['toateProgr'])) {
						echo'<p>Vezi toate programarile</p>';
						af_toate_progr();
					}
					
					if (isset($_POST['progrAcc'])) {
						echo'<p>Vezi programarile acceptate</p>';
						af_progr_acc();
					}
					
					if (isset($_POST['progrFin'])) {
						echo'<p>Vezi programarile finalizate</p>';
						af_progr_fin();
					}
					
					if (isset($_POST['progrAnulate'])) {
						echo'<p>Vezi programarile anulate</p>';
						af_progr_amanate();
					}
					/*
					if (isset($_POST['progrCl'])) {
						
						echo'Vezi programrile unui client<br><br>';
								
					}
					
					if (isset($_POST['progrAng'])) {
						echo'Vezi programarile unui angajat';
					}
					*/
				?>
			</div>
			
		</div>
	</div>
	
	
	
	

	</body>
</html>
		<!DOCTYPE>
<html>
	<head>
		<link rel="stylesheet"href="prevAndTopBCSS.css">
		<link rel="stylesheet" href="vizProgrSefCSS.css">
		
		<title>Admin Account</title>
	</head>
	<body>
	<?php
	include "db_connect.php";
	include "functions2.php";
	$mailUser=$_GET['mailUser'];
	//echo 'mailUser: '.$mailUser.'<br>';
	echo'<a href="gestPretServ.php?mailUser='.$mailUser.'" class="previous">&laquo; Previous</a>'; 
		
	
	$sql = "SELECT numeAng, nrTelAng, dataNaAng FROM angajat WHERE mailAng ='$mailUser'";
	$result= $conn->query($sql);
	$row = $result->fetch_assoc();
	
	$numeAng= $row["numeAng"];
	$nrTelAng= $row["nrTelAng"];
	$dataNaAng= $row["dataNaAng"];

	?>
	<div id="topbarid" class="topbar">
		<div id="tblid" class="tbl">
			<a href="index.php">Deconecteaza-te</a>
		</div>
		<div id="tbrid" class="tbr">
			<?php echo '<a href="adminAccount.php?mailUser='.$mailUser.'">Acasa</a>';?>
			<a href="galerie.php">Galerie</a>
			<a href="aboutUs.php"> Despre Noi</a>
			<a href="aboutServices.php"> Servicii Oferite </a>
			<a href="reviews.php">Reviews </a>
			<!-- <a href="slideshow.php">slides </a> -->
		</div>
	</div>
	
	<div id="mainid" class="mainDiv">
		<div id="progrid" class="progr">
			<p>Vizualizare programari</p>
			<form name="toateProgr" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF?mailUser='.$mailUser.'"]);?>" method="POST">   <!--  -->
				  <button class="buton" name="toateProgr" type="submit"> Vezi toate programarile</button>
			</form>
		
			<form name="progrAcc" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF?mailUser='.$mailUser.'"]);?>" method="POST">   <!--  -->
				 <button class="buton" name="progrAcc" type="submit"> Vezi programarile acceptate</button>
			</form>
			
			<form name="progrFin" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF?mailUser='.$mailUser.'"]);?>" method="POST">   <!--  -->
				 <button class="buton" name="progrFin" type="submit"> Vezi programrile finalizate</button>
			</form>
			
			<form name="progrAnulate" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF?mailUser='.$mailUser.'"]);?>" method="POST">   <!--  -->
				 <button class="buton" name="progrAnulate" type="submit"> Vezi programarile anulate</button>
			</form>
			
			<!--
			<form name="progrCl" action="<?php //echo htmlspecialchars($_SERVER["PHP_SELF?mailUser='.$mailUser.'"]);?>" method="POST"> 
				 <!--<button class="buton" name="progrCl" type="submit"> Vezi programrile unui client</button>
			</form>
			-->
			
			<!-- 
			<form name="progrAng" action="<?php//echo htmlspecialchars($_SERVER["PHP_SELF?mailUser='.$mailUser.'"]);?>" method="POST">  
				 <button class="buton" name="progrAng" type="submit"> Vezi programarile unui angajat</button>
			</form>
			-->
			
		</div> 
		
		<div id="afisare" class="afisare">
			
			<div class="afProgr">
				<?php
					//echo "aici afisam programarile: ";
					if (isset($_POST['toateProgr'])) {
						echo'Vezi toate programarile<br>';
						af_toate_progr();
					}
					
					if (isset($_POST['progrAcc'])) {
						echo'Vezi programarile acceptate';
						af_progr_acc();
					}
					
					if (isset($_POST['progrFin'])) {
						echo'Vezi programarile finalizate<br>';
						af_progr_fin();
					}
					
					if (isset($_POST['progrAnulate'])) {
						echo'Vezi programarile anulate';
						af_progr_amanate();
					}
					/*
					if (isset($_POST['progrCl'])) {
						
						echo'Vezi programrile unui client<br><br>';
								
					}
					
					if (isset($_POST['progrAng'])) {
						echo'Vezi programarile unui angajat';
					}
					*/
				?>
			</div>
			
		</div>
	</div>
	
	
	
	

	</body>
</html>
		