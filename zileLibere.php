<!DOCTYPE HTML>

<html>
	<head>
		<link rel="stylesheet"href="zileLibereCSS.css">
		<link rel="stylesheet"href="prevAndTopBCSS.css">
		<title>Zile Libere</title>
		
	</head>
	<body>
	<?php
		include "db_connect.php";
		$mailUser=$_GET['mailUser'];
	
		echo' <div id="topbarid" class="topbar">
		<div id="tblid" class="tbl"> ';
			echo'<a href="index.php"> Deconecteaza-te </a>';
		echo'</div>
		<div id="tbrid" class="tbr">';
			echo'<a href="angAccount.php?mailUser='.$mailUser.'">Acasa</a>';
			echo'<a href="galerieF2.php?mailUser='.$mailUser.'">Galerie</a>';
			echo'<a href="aboutUs.php?mailUser='.$mailUser.'"> Despre Noi</a>';
			echo'<a href="aboutServices.php?mailUser='.$mailUser.'"> Servicii Oferite </a>';
			echo'<a href="reviews.php?mailUser='.$mailUser.'"> Reviews </a>';
	echo'	</div>
	</div>';

		echo'<a href="angAccount.php?mailUser='.$mailUser.'" class="previous">&laquo; Inapoi</a>'
	?>
	
	<div class="titlu">
	<h2> Zile Libere </h2>
	</div>
		<?php
		include "db_connect.php";
		$mailUser=$_GET['mailUser'];
		$sql = "SELECT idAng, numeAng FROM angajat WHERE mailAng ='$mailUser'";
		$result= $conn->query($sql);
		$row = $result->fetch_assoc();
		$idAng=$row["idAng"];
		$numeAng= $row["numeAng"];
		$today=date('Y-m-d');
		$zileLibere = "SELECT ziLibera FROM zilelibere WHERE idAng ='$idAng' && ziLibera >= '$today' ";
			$result= $conn->query($zileLibere);
			if ($result->num_rows > 0) {
				echo '<div class="vizZileLibere">';
				echo 'Zile libere:<br>';
				  // output data of each row
				while($row = $result->fetch_assoc()) {
					echo '- '.$row[ziLibera].'<br>';
				}
				echo'</div';
			}
			else {
				echo'<div class="nuExZileLibere">';
					echo "Nu aveti zile libere programate deocamdata.";
				echo'</div>';
			
			}
		?>

	</body>
</html>
		