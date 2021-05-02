<!DOCTYPE HTML>

<html>
	<head>
		<link rel="stylesheet"href="gestPretServCSS.css">
		<link rel="stylesheet"href="prevAndTopBCSS.css">
		<title>Gestionare Promotii</title>
		
	</head>
	<body>
	
	<?php
	$mailUser=$_GET['mailUser'];
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
	<h2>Gestionare Promotii</h2>
	</div>
	<?php
	include "db_connect.php";
	include "functions2.php";
	
	
	
		echo'<a href="adminAccount.php?mailUser='.$mailUser.'" class="previous">&laquo; Inapoi</a>'; 
		
		echo '<div class="gestPretServ">';
			echo '<div class="crServ">';
					echo '<a href="addCodPromo2.php?mailUser='.$mailUser.'">Adauga un nou cod promotional</a>';
			echo'</div>';
			echo'<div class="vizPretServ">';   // inc div vizPretServ
				
				$sql2 = "SELECT DISTINCT codVoucher FROM voucher ";//ORDER BY numeAng ASC";
					$result= $conn->query($sql2);
					if ($result->num_rows > 0) {
						$color="lighterColor";
							while($row = $result->fetch_assoc()) {
								$codVoucher=$row["codVoucher"];
									echo'<div class="'.$color.'">';
									echo 'Cod Promotional: '.$codVoucher.' <br>';
									echo 'Folosit: '; count_cod($codVoucher,'folosit'); 
									echo 'Disponibil: '; count_cod($codVoucher,'disponibil');
											echo'<div class="stergeServ">';
												echo '<a href="deleteCodVoucher.php?codVoucher='.$codVoucher.'&mailUser='.$mailUser.'">Anuleaza Codul</a>';
											echo'</div>';
											
									echo'</div>';
								if ($color =="lighterColor"){
									$color="color";
								}else{
									$color="lighterColor";
								}
							}
					}
					else{
						echo 'Nu exista nici un cod promotional momentan.';
					}
			echo'</div>';  //sf div vizPretServ
			
			
	?>	
			
						
						
	
		</div>  <!--sf div gestPretServ-->
	

	</body>
</html>
		