<!DOCTYPE HTML>

<html>
	<head>
		
		<title>Sterge</title>
		
	</head>
	<body>
		<?php
		
		include "db_connect.php";
		include "functions2.php";
		$mailUser=$_GET['mailUser']; 
		
		if($_GET['idTip']){
			$idTip = $_GET['idTip'];
			delete_tipCaroserie($idTip);
			header("Location:gestMasini.php?mailUser=$mailUser");
		}
		
		if($_GET['idMasina']){
			$idMasina = $_GET['idMasina'];
			delete_masina($idMasina);
			header("Location:gestMasini.php?mailUser=$mailUser");
		}
		
		?>
	
	</body>
</html>
		