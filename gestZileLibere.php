<!DOCTYPE HTML>
<html>
	<head>
		<link rel="stylesheet"href="addZiLiberaCSS.css">
		<link rel="stylesheet"href="buttonsCSS.css">
		<link rel="stylesheet"href="prevAndTopBCSS.css">
		<title>Zile Libere</title>
	</head>
	<body>
	<?php
	include "db_connect.php";    /*c - curent;   n- nou */
	include "functions2.php";
	$idAng=$_GET['idAng'];
	$mailUser=$_GET['mailUser'];
	$nume = get_numeAng_by_idAng($idAng);
	
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
		echo '<h2>Zile Libere</h2>';
	echo '</div>';

	echo'<a href="gestContAng.php?mailUser='.$mailUser.'" class="previous">&laquo; Inapoi</a>';

	$today = date('Y-m-d');
	
	$maxdate = date_create($today);
	date_modify($maxdate, '+2 months');
	//echo date_format($maxdate, 'Y-m-d');
	
	$mindate = date_create($today);
	date_modify($mindate, '+ 2 days');
	//echo date_format($mindate, 'Y-m-d');
	
	?>
	
<div class="container">
	
	<div class="vizProgrAng">
	<h2>Zilele libere:</h2>
		<p><b>Nume angajat: <?php echo $nume?> </b></p>
		
	<?php
		
			$zileLibere = "SELECT ziLibera FROM zilelibere WHERE idAng ='$idAng' && ziLibera >= '$today' ";
			$result= $conn->query($zileLibere);
			//echo '<div class="vizZileLibere">';
			
			if ($result->num_rows > 0) {
				echo 'Zile libere:<br>';
				//echo '<div class="vizZileLibere">';
				//echo 'Zile libere:<br>';
				  // output data of each row
				while($row = $result->fetch_assoc()) {
					/*echo '- '.$row[ziLibera].'<br>';*/
					setlocale(LC_ALL, 'ro_RO');
					echo strftime("%A,%e %B %Y",strtotime($row[ziLibera])).'<br>';
				}
				//echo'</div';
			}
			else {
				//echo'<div class="nuExZileLibere">';
					echo "Angajatul nu are zile libere programate deocamdata.";
			//	echo'</div>';
			
			}
	?>
	</div> <!-- inch div vizProgrAng -->
			
	<div class="addContainer">
	<form name="nameEditForm" onsubmit="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">   <!--  -->
		<h2><b>Adauga o zi libera unui angajat</b></h2>
		<p><b>Nume angajat: <?php echo $nume?> </b></p>
		<div class="dataEdit">
			<label for="ziLibera"><b>Zi libera:</b></label>
			<input id="ziLibera"  name="ziLibera" type="date" placeholder="'dd-mm-yyyy'?>" max="<?php echo date_format($maxdate, 'Y-m-d')?>"  min="<?php echo date_format($mindate, 'Y-m-d')?>" required>
			
		</div>
			
		<button name="pressAdd" type="submit">Adauga zi libera</button>
	</form>
	
	<?php
		if (isset($_POST['pressAdd'])) {
			$ziLibera = $_POST['ziLibera'];
			
			//echo'nume:'.$nume;
			//echo'<br>zi libera:'.$ziLibera;
			if ( exista_ziLibera($idAng, $ziLibera) ){
				echo $nume.' are deja ziua de '.$ziLibera.' libera.<br>';
			}
			else{
				$sql="SELECT idProg, pretProg FROM programare WHERE idAng = '$idAng' && dataProg = '$ziLibera'";
				$result = $conn->query($sql);
				if($result->num_rows > 0) {
					//echo 'Daca angajatul are programari pentru data '.$ziLibera.', o parte din programarile acestuia vor fi redirectionate catre alti angajati, iar o parte vor fi amanate pana cand clientul reprogrameaza.<br>';
					echo '<br>'.$nume.' are urmatoarele programari pentru data '.$ziLibera.':<br>';
					while($row = $result->fetch_assoc()) {
						$idProg=$row["idProg"];
						echo 'ID progrmare: '.$row["idProg"].'  ||  pret: '.$row["pretProg"].'<br>';
					}
					
					echo '<a class="smallButton" href="addZiLiberaProcess.php?mailUser='.$mailUser.'&idAng='.$idAng.'&ziLibera='.$ziLibera.'">Da, adauga zi libera</a>';
					echo '<a class="smallButton" href="gestZileLibere.php?mailUser='.$mailUser.'&idAng='.$idAng.'">Nu, renunta</a>';
				}
				else{
					echo $nume.' nu are programari pt data '.$ziLibera.'<br>';
					add_ziLibera($idAng,$ziLibera);
					header("Location:gestZileLibere.php?mailUser=$mailUser&idAng=$idAng");
					echo 'Ziua libera a fost adaugata!<br>';
				}

			}
			//add_ziLibera($idAng,$ziLibera);
			///header("Location:gestContAng.php?mailUser=$mailUser");
					

		}
	?>
	</div> <!-- inch div class="addContainer" -->
	
	
	
	
	<div class="deleteContainer">
	<form name="nameEditForm" onsubmit="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">   <!--  -->
		<h2><b>Sterge o zi libera a unui angajat</b></h2>
		<p><b>Nume angajat: <?php echo $nume ?> </b></p>
		<div class="dataEdit">
			<label for="ziLibera"><b>Data:</b></label>
			<input id="ziLibera"  name="ziLibera" type="date" <?php if ( isset($_GET['delete']) && $_GET['delete'] == 1 ) { echo 'value="'.$_GET['ziLibera'].'"';}?> placeholder="dd-mm-yyyy" max="<?php echo date_format($maxdate, 'Y-m-d')?>"  min="<?php echo date_format($mindate, 'Y-m-d')?>" required>
			
		</div>
			
		<button name="pressDelete" type="submit">Sterge zi libera</button>
	</form>
	
	<?php
		if ( isset($_GET['delete']) && $_GET['delete'] == 1 )
			{
				 // treat the succes case ex:
				 echo "Am sters". $_GET['ziLibera']."<br>";
				 $delete=0;
			}
		if ( isset($_GET['delete']) && $_GET['delete'] == 0 )
			{
				 // treat the succes case ex:
				 echo "Nu exista aceasta zi libera.";
				 $delete=0;
			}
		if (isset($_POST['pressDelete'])) {
			$ziLibera = $_POST['ziLibera'];
			
			//echo'nume:'.$nume;
			//echo'<br>zi libera:'.$ziLibera;
			if ( exista_ziLibera($idAng, $ziLibera) ){
				
					sterge_ziLibera($idAng,$ziLibera);
				
					$delete=1;
					
					header("Location:gestZileLibere.php?mailUser=$mailUser&idAng=$idAng&delete=$delete&ziLibera=$ziLibera");
				
			}
			else{
				echo $nume.' nu are ziua de '.$ziLibera.' libera.<br>';
				$delete=0;
				//header('Refresh: 5; url=http://yoursite.com/index.html');
				header("Location:gestZileLibere.php?mailUser=$mailUser&idAng=$idAng&delete=$delete");
				

			}
			//add_ziLibera($idAng,$ziLibera);
			///header("Location:gestContAng.php?mailUser=$mailUser");
					

		}
	?>
	</div> <!-- inch div class="deleteContainer" -->
	
</div> <!-- inch div class="container"-->
	</body>
</html>
		
