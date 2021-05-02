<?php
if(isset($_POST['submit'])){
	$mailUser=$_GET['mailUser'];
	$carChoice=$_POST['carChoice'];
	$tipChoice=$_POST['tipChoice'];
		if($carChoice != "noCar" && $tipChoice != "noChoice" ){
			header("Location:progrNoua.php?mailUser=$mailUser&carChoice=$carChoice&tipChoice=$tipChoice");
			exit();
		}
		
}
?>
<!DOCTYPE HTML>
<html>
	<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet"href="buttonsCSS.css">
	<link rel="stylesheet"href="prevAndTopBCSS.css">
	<link rel="stylesheet"href="alegeMasinaCSS.css">
		<title>Creeaza o programare</title>
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
			echo'<a href="myAccount.php?mailUser='.$mailUser.'">Acasa</a>';
			echo'<a href="galerieF2.php?mailUser='.$mailUser.'">Galerie</a>';
			echo'<a href="aboutUs.php?mailUser='.$mailUser.'"> Despre Noi</a>';
			echo'<a href="aboutServices.php?mailUser='.$mailUser.'"> Servicii Oferite </a>';
			echo'<a href="reviews.php?mailUser='.$mailUser.'"> Reviews </a>';
	echo'	</div>
	</div>';
		echo'<a href="myAccount.php?mailUser='.$mailUser.'" class="previous">&laquo; Inapoi</a>';
		?>
		<div class="createProgrForm">
		<h2>Alege masina</h2>
		<form name="progrForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF?mailUser='.$mailUser.'"]);?>" method="POST">   <!--  -->
			<div class=progr>
				<?php
					$sql= " select idMasina, marca, model from masini ";
						$result = $conn->query($sql);
							echo'<select name="carChoice"  size="20" >';
								echo'<option value="noCar" selected></option>'; /* in caz ca utilizatorul nu alege nici o masina*/
								if ($result->num_rows > 0) {
									while($row = $result->fetch_assoc()) {
										echo $row['marca'].'<br>';
										echo'<option value="'.$row['idMasina'].'">'.$row['marca'].' '.$row['model'].' </option>';
									}
								}
								echo'<option value="otherCar" >Alta</option>';
							echo'</select>';
					
		 echo' </div>';
		
		$sql2= "select idTip, numeTip from tipcaroserie";
			$result2 = $conn->query($sql2);
					echo '<b><span style="font-size: 20px;">Tip caroserie:</span></b>';
				
					echo'<select name="tipChoice">';
						 echo'<option value="noChoice" selected></option>'; /* in caz ca utilizatorul nu alege nici un codVoucher*/
						
							if ($result2->num_rows > 0) {
						
								while($row = $result2->fetch_assoc()) {
									//echo $row['numeTip'].'<br>';
									 echo'<option value="'.$row['idTip'].'">'.$row['numeTip'].'</option>';
									}
								
							}
							echo'<option value="otherChoice" >Altul</option>';
							echo'</select>';
		echo' <br><br>';
		echo'
		  <button class="smallButton" name="submit" type="submit">Continua</button>
		</form>';
		
if(isset($_POST['submit'])){
	$mailUser=$_GET['mailUser'];
	$carChoice=$_POST['carChoice'];
	$tipChoice=$_POST['tipChoice'];
		if($carChoice == "noCar" ){
			echo '<br> ';
			echo'<span style="font-size: 18px;">Nu ati ales modelul masinii pentru care creati programarea.</span>';
		}
		if($tipChoice == "noChoice" ){
			echo'<br><span style="font-size: 18px;">Nu ati ales tipul de caroserie al masinii.</span>';
		
		}
}
?>
	
	</div>
	</body>
</html>
		