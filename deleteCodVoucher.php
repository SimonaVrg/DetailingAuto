
<!DOCTYPE HTML>

<html>
	<head>
		<link rel="stylesheet"href="editServiciuCSS.css">
		<link rel="stylesheet"href="prevAndTopBCSS.css">
		
		<title>Sterge Serviciu</title>
	</head>
	<body>
		<?php
	//echo "Am intrat in deleteCodVoucher.php<br><br><br>";

	$mailUser=$_GET['mailUser'];
	$codVoucher=$_GET['codVoucher'];

		
		echo'<a href="gestPromotii.php?mailUser='.$mailUser.'" class="previous">&laquo; Inapoi</a>'; 
	
		
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
			<h2>Sterge un cod promotional</h2>
		</div>
		<div class="editContainer">
			<form name="stergeCodPromo" onsubmit="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">   <!--  -->
				<h2>Esti sigur ca vrei sa stergi acest cod promotional?<br></h2>
				<p>Acesta va ramane disponibil doar pentru programarile deja acceptate.</p>
				<?php 
					echo 'Cod Promotional: '.$codVoucher.' <br>';
				?>
				<button name="pressSterge" type="submit">Da, sterge codul</button>
				<button name="pressRenunta" type="submit">Nu, renunta</button>
			</form> 
		<?php
		if (isset($_POST['pressSterge'])) {
				echo 'Stergem codul promotional '.$codVoucher.'<br>';
				include"functions2.php";
				include "db_connect.php";
				deleteCodVoucher_withDates($codVoucher);
				echo "Codul a fost anulat!";
					header("Location:gestPromotii.php?mailUser=$mailUser");
				
				/*
				 	$sql="DELETE FROM voucher WHERE codVoucher='$codVoucher'";

					if($conn->query($sql) === TRUE){
					echo "Codul a fost anulat!";
					header("Location:gestPromotii.php?mailUser=$mailUser");
					}
					else{
					echo "Error: ".$sql."<br>".$conn->error;
					}
					$conn->close();
					*/
		}
		if (isset($_POST['pressRenunta'])) {
				echo 'Nu stergem serviciul<br>';
					header("Location:gestPromotii.php?mailUser=$mailUser");
		}
						
		?>
	
	</div>
	</body>
</html>
		