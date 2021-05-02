<!DOCTYPE HTML>
<html>
	<head>
		<link rel="stylesheet"href="addCodPromoCSS.css">
		<link rel="stylesheet"href="buttonsCSS.css">
		<link rel="stylesheet"href="prevAndTopBCSS.css">
			<title>Adaugare cod promotional</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	
	</head>
	<body>
	<?php
	include "db_connect.php";   
	include "functions2.php";
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
	
	echo '<div class="titlu">';
		echo '<h2>Adauga un nou cod promotional</h2>';
	echo '</div>';

	echo'<a href="gestPromotii.php?mailUser='.$mailUser.'" class="previous">&laquo; Inapoi</a>'; 
		
	
	?>
	

<div class="container">

	<div class="vizProgrAng">
	<h2>Coduri promotionale existente:</h2>
		
	<?php
		/*$coduriPromo = "SELECT DISTINCT codVoucher FROM voucher ";*/
		$coduriPromo = "SELECT DISTINCT codVoucher FROM coduripromo ";
		
		$result= $conn->query($coduriPromo);
		//echo '<div class="vizZileLibere">';
		
		if ($result->num_rows > 0) {
			echo 'Coduri promotionale:<br>';
			//echo '<div class="vizZileLibere">';
			//echo 'Zile libere:<br>';
			  // output data of each row
			while($row = $result->fetch_assoc()) {
				echo '- '.$row[codVoucher].'<br>';
			}
			//echo'</div';
		}
		else {
			//echo'<div class="nuExZileLibere">';
				echo "Nu exista coduri promotionale disponibile.";
		//	echo'</div>';
		
		}
	?>
	</div> <!-- inch div vizProgrAng -->
			
<div class="addContainer">
	<div class="ttEdit">
		<div class="tooltip"> <i style="font-size:22px;  position:fixed; margin-left: 0px;" class="fa">&#xf05a;</i>
			  <span class="tooltiptext">
			
		<p>
			Un cod promotional valabil urmeaza tiparul 2litereMARI 2cifre 2litereMARI <br>
			<span style="font-size:14px;">Exemple: AA00AA, AZ09AZ, AZ90ZA </span>
		</p>
				</span>
			</div>

		
	</div>
	<form name="nameEditForm" onsubmit="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">   <!--  -->
		<h2><b>Adauga un cod promotional </b></h2>
			
		<div class="dataEdit">
		
			<label for="codVoucher"><b>Cod Promotional:</b></label>
				<input id="codVoucher" name="codVoucher" type="text" placeholder="AX67FG" pattern="[A-Z]{2}[0-9]{2}[A-Z]{2}" required>
			<br>
			
			<label for="procent"><b>Procent:</b></label>
				<input id="procent" name="procent" type="number" placeholder="%" min="1" max="99" required>
			<br>
			
			<?php
			$mindate = date_create($today);
			//date_modify($mindate, '+ 2 days');
			//echo date_format($mindate, 'Y-m-d');
			?>
			
			<label for="startDate"><b>Data Inceput:</b></label>
				<input id="startDate"  name="startDate" type="date" placeholder="mm/dd/yyyy" min="<?php echo date_format($mindate, 'Y-m-d')?>" required>
			  
			  <br>
			  
			<label for="endDate"><b>Data Sfarsit:</b></label>
				<input id="endDate"  name="endDate" type="date" placeholder="mm/dd/yyyy"  min="<?php echo date_format($mindate, 'Y-m-d')?>"  required>
				
		</div>
		<button class="formButton" name="pressAdd" type="submit">Adauga cod promotional</button>
	</form>
	
	<?php
		if ( isset($_GET['add']) && $_GET['add'] == 1 )
			{
				 // pe aici se face afisarea dupa ce se apasa butonul 'Adauga cod promotional'
				 echo "Am adaugat codul promotional ". $_GET['codVoucher']."<br>";
				 $add=0;
			}
		if ( isset($_GET['add']) && $_GET['add'] == 0 )
			{
				 // pe aici se face afisarea
				 echo "Deja exista codul promotional ". $_GET['codVoucher']."<br>";
				 $add=0;
			}
		if (isset($_POST['pressAdd'])) {
			$mailUser=$_GET['mailUser'];
			$codVoucher = $_POST['codVoucher'];
			$procent = $_POST['procent'];
			$startDate = $_POST['startDate'];
			$endDate = $_POST['endDate'];
			
			
			//echo'nume:'.$nume;
			//echo'<br>zi libera:'.$ziLibera;
			if (codVoucher_inDB_withDates($codVoucher) ){
				// daca deja exista codul promotional -> $add=0; afisarea mesajului se face dupa header
					$add=0;
					header("Location:addCodPromo2.php?mailUser=$mailUser&add=$add&codVoucher=$codVoucher");
				
			}
			else{
				if ($startDate > $endDate){
					echo 'Data de inceput a promotiei nu poate fi mai mare decat data de sfarsit.';
				}
				else{
					/*add_codVoucher_inDB($codVoucher);*/
					add_codVoucher_inDB_withDates($codVoucher,$procent,$startDate,$endDate);
				
					// daca am adaugat codul promotional -> $add=1; afisarea mesajului se face dupa header
					$add=1;
					header("Location:addCodPromo2.php?mailUser=$mailUser&add=$add&codVoucher=$codVoucher");
				
				}
				
				}

			}
			//add_ziLibera($idAng,$ziLibera);
			///header("Location:gestContAng.php?mailUser=$mailUser");
					

		
	?>
</div> <!-- inch div class="addContainer" -->
	
	
	
	
	
	</body>
</html>
		
