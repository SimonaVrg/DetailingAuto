<!DOCTYPE HTML>
<html>
	<head>
		<link rel="stylesheet"href="prevAndTopBCSS.css">
			<link rel="stylesheet"href="buttonsCSS.css">
		<link rel="stylesheet"href="giveReviewCSS.css">
		<title>Lasa Review</title>
	</head>
	<body>
	<?php
		include "db_connect.php";
		include "functions2.php";
		$mailUser=$_GET['mailUser'];
		$sql = "SELECT idCl FROM client WHERE mailCl ='$mailUser'";
		$result= $conn->query($sql);
		$row = $result->fetch_assoc();
		$idCl=$row["idCl"];
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
		echo'<a href="myAccount.php?mailUser='.$mailUser.'" class="previous">&laquo; Inapoi</a>'
	?>
	<div class="titlu">
	<h2> Lasa-ne un review </h2>
	</div>
	<?php
		//Vizualizare programari client
		$today=date('Y-m-d');
		$sql2 = "SELECT idProg, dataProg, listaServicii, pretProg, codVoucher, statusProg FROM programare WHERE idCl = '$idCl' && statusProg ='Finalizata' && dataProg<='$today' ORDER BY dataProg";
			$result= $conn->query($sql2);
			if ($result->num_rows > 0) {
			echo '<div class="gestProgr">';	  // div gestProgr
				//echo'<div class="vizProgr">';
					while($row = $result->fetch_assoc()) {
						$idProg=$row["idProg"];
						$dataProg= $row["dataProg"];
						$listaServ= $row["listaServicii"];
						$codVoucher= $row["codVoucher"];
						$pretProg= $row["pretProg"];
						$statusProg= $row["statusProg"];
						if( $dataProg <= date('Y-m-d')){
							echo'<div class="containerReview">';
								echo'<div class="'.$statusProg.'">';
								/*	echo'<div class="deleteProg">';
										echo '<a href="deleteProg.php?idProg='.$idProg.'&idCl='.$idCl.'&mailUser='.$mailUser.'&dataProg='.$dataProg.'&codVoucher='.$codVoucher.'&listServ='.$listaServ.'&pretProg='.$pretProg.'&idAng='.$idAng.'">Sterge din istoric</a>';
									echo'</div>';*/
									echo 'ID programare: '.$idProg.' <br>';
									echo 'Data programare: '.$dataProg.' <br>';
									echo 'Lista servicii alese: '.$listaServ.' <br>';
									if($codVoucher!=''){
									echo 'Cod voucher folosit: '.$codVoucher.' <br>';
									}
									echo 'Pret: '.$pretProg.' <br>';
									echo 'Status: '.$statusProg.' <br>';
								echo'</div>'; //inch div statusProg
								echo'<div class="review">';
									?>
									<!--//daca programarea are deja review, il afisam si clientul poate sa il modifice-->
										<!--<form name="progrForm" action="<?php// echo htmlspecialchars($_SERVER["PHP_SELF?mailUser='.$mailUser.'"]);?>" method="POST">   <!--  -->
										<form name="progrForm"  method="POST">   <!--  -->
												<label for="textReview"><b><?php if (get_review_by_idProg($idProg) == false) echo 'Adauga un review:'; else echo 'Modifica review existent:';?></b></label><br>
												<?php $review=get_review_by_idProg($idProg); ?>
												<textarea id="textReview"  type="text" name="<?php echo 'textReview'.$idProg;?>" rows="5" required><?php echo $review; ?></textarea>
											<br>
										  <input type="checkbox" name="check" <?php if (get_displayNume_by_idProg($idProg) == 'anonim') echo 'checked';?> >Posteaza ca si anonim<br>
										  <button class="formButton" name="<?php echo 'giveReview'.$idProg;?>" type="submit">Salveaza</button>
										  <button class="formButton" name="<?php echo 'deleteReview'.$idProg;?>" type="submit">Sterge review</button>
										</form> 
									<?php
									 if(isset($_POST['giveReview'.$idProg])) { 
											$displayNume=get_displayNume_by_idProg($idProg);
											if(!isset($_POST['check'])) {
												if ($displayNume == 'anonim'){
													update_displayNume($idProg,'public');
												}
											}else{
												if ($displayNume == 'public'){
													update_displayNume($idProg,'anonim');
												}
											}
											$review=$_POST['textReview'.$idProg];
											if (check_review($review)){
												if (get_review_by_idProg($idProg) == false){ //daca nu exista review, adaugam
													add_review_inDB($idProg,$review);
													//header("Location:giveReview.php?mailUser=$mailUser");
													echo'<meta http-equiv="refresh" content="0">';
												}
												else{
												//daca exista, UPDATE in baza de date
												update_review($idProg,$review);
												//header("Location:giveReview.php?mailUser=$mailUser"); //refresh la pagina pt a vedea ce review am adaugat
												echo'<meta http-equiv="refresh" content="0">';
												}
											}
											else{
												echo 'un review trebuie sa aiba cel putin 5 caractere';
											}
										}
									 if(isset($_POST['deleteReview'.$idProg])) {
										 delete_review($idProg);
										 //header("Location:giveReview.php?mailUser=$mailUser"); //refresh la pagina pt a vedea ce review am adaugat
										 echo'<meta http-equiv="refresh" content="0">';
									 }
										//echo '<a href="deleteProg.php?idProg='.$idProg.'&idCl='.$idCl.'&mailUser='.$mailUser.'&dataProg='.$dataProg.'&codVoucher='.$codVoucher.'&listServ='.$listaServ.'&pretProg='.$pretProg.'&idAng='.$idAng.'">Sterge din istoric</a>';
									echo'</div>'; //inch div review
							echo'</div>'; //inch div containerReview
						}
					}
				//echo'</div>'; //inch div vizProgr
			echo '</div>'; //sf div gestProgr
		}
			else{
				echo'<div class="nuExProgr">';
			  echo "Nu exista programari in istoricul dumneavoastra momentan!<br>";
			  echo'</div>';
			}
		?>
	</body>
</html>
		