<!DOCTYPE HTML>

<html>
	<head>
		<link rel="stylesheet"href="prevAndTopBCSS.css">
		<link rel="stylesheet"href="reviewsCSS.css">
		<title>Reviews</title>
		
	</head>
	<body>
	
	
	<?php
		include "functions2.php";
			include "db_connect.php";
		$mailUser=$_GET['mailUser']; 
		
		if ($mailUser=='0'){
				echo'<a href="index.php" class="previous">&laquo; Inapoi</a>'; 
			}else{
				$tokenUser=getToken($mailUser);
				if ($tokenUser==1){
					echo'<a href="adminAccount.php?mailUser='.$mailUser.'" class="previous">&laquo; Inapoi</a>'; 
				}
				else{
					if($tokenUser==0){
					echo'<a href="angAccount.php?mailUser='.$mailUser.'" class="previous">&laquo; Inapoi</a>'; 
					}else{
						echo'<a href="myAccount.php?mailUser='.$mailUser.'" class="previous">&laquo; Inapoi</a>'; 
					}
				}
			}
		?>
	<?php
	echo' <div id="topbarid" class="topbar">
		<div id="tblid" class="tbl"> ';
		if($mailUser=='0'){
			echo'<a href="logIn.php?mailUser='.$mailUser.'">Contul Meu</a>';
			echo'<a href="signIn.php?mailUser='.$mailUser.'"> Mă Înregistrez </a>';
		}
		else{
			echo'<a href="index.php?"> Deconecteaza-te </a>';
		}
		echo'</div>
		<div id="tbrid" class="tbr">';
		if($mailUser=='0'){
			echo'<a href="index.php">Acasa</a>';
		}else{
			$tokenUser=getToken($mailUser);
			if ($tokenUser==1){
				echo'<a href="adminAccount.php?mailUser='.$mailUser.'">Acasa</a>';
			}
			else{
				if($tokenUser==0){
					echo'<a href="angAccount.php?mailUser='.$mailUser.'">Acasa</a>';
				}else{
					echo'<a href="myAccount.php?mailUser='.$mailUser.'">Acasa</a>';
				}
			}
		}
			echo'<a href="galerieF2.php?mailUser='.$mailUser.'">Galerie</a>';
			echo'<a href="aboutUs.php?mailUser='.$mailUser.'"> Despre Noi</a>';
			echo'<a href="aboutServices.php?mailUser='.$mailUser.'"> Servicii Oferite </a>';
			echo'<a href="reviews.php?mailUser='.$mailUser.'"> Reviews </a>';
	echo'	</div>
	</div>';
	?>
	
	<div class="titlu">
		<h2> Reviews </h2>
	</div>
	<?php
		$sql2 = "SELECT idProg, review FROM review";
			$result= $conn->query($sql2);
			if ($result->num_rows > 0) {
			echo '<div class="gestProgr">';	  // div gestProgr
				
				//echo'<div class="vizProgr">';
					while($row = $result->fetch_assoc()) {
						
						$idProg=$row["idProg"];
						$review= $row["review"];
						
						
							echo'<div class="containerReview">';
								echo'<div class="Finalizata">';
									if (get_displayNume_by_idProg($idProg) == 'anonim'){
										echo '<b>Review postat anonim </b><br>';
									}
									else {
										$numeCl=get_numeCl_by_idProg($idProg);
										echo '<b>Nume: '.$numeCl.' </b><br>';
									}
									
									echo 'Review:<br> '.$review.' <br>';
							
								echo'</div>'; //inch div Finalizata
								
							echo'</div>'; //inch div containerReview
						
					}
				//echo'</div>'; //inch div vizProgr
			
							
				
			echo '</div>'; //sf div gestProgr
			
		}
			else{
				echo'<div class="nuExProgr">';
			  echo "Nu exista review-uri momentan!<br>";
			  echo'</div>';
			 
			}
		?>

	</body>
</html>
		