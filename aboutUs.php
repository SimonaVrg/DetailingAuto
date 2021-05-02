<!DOCTYPE>
<html>
	<head>
		<link rel="stylesheet"href="prevAndTopBCSS.css">
		<link rel="stylesheet" href="aboutUsCSS.css">
		<title>Despre noi</title>
	</head>
	<body>
	
		<?php
		include "functions2.php";
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
		<h2>Despre Noi</h2>
	</div>
	
	
	<div class="aboutUs">
	<p>Noi suntem Paul și Antonio. Suntem prieteni încă din școala generală, am locuit și locuim în același oraș, iar crescând împreună ne-am și dezvoltat o 
	pasiune comună: mașinile.
	<br>Ne-a plăcut dintotdeauna să avem grijă ca mașinile noastre să fie curate, și de-a lungul timpului am învătat multe lucruri despre diferite tipuri 
	
	de produse și tehnici de îngrijire a mașinilor,
	pentru ca rezultatele să fie cât de bune posibile. <br>După ce prietenii au vazut că ne pricepem, ne-au încurajat să transformăm această pasiune într-o 
	afacere, iar acum suntem mândri să putem spune că administrăm propria afacere.
	<br>Experiența ne spune că mașina ta nu este ca oricare alta, așa că ne-am ambiționat și ne-am specializat pentru ca rezultatele detailingului auto pe
	care noi îl oferim să fie pe măsură. 
<br>Din dorința de a avea numai clienți fericiți, am ales să nu facem nici un compromis când vine vorba de calitatea produselor pe care le folosim.
Noi îti stăm la dispoziție și pentru consultanță. Doar dă-ne un telefon iar unul din angajații noștri îți va da toate informațiile de care ai nevoie.
<br>Programarea nu a fost niciodată mai simplă!
<br>Creează-ți un cont, alege tot ceea ce ai nevoie pentru mașina ta și bucură-te de codurile promoționale! De restul ne ocupăm noi!<br>
Te așteptăm!

</p>
	</div>
	
	
	
	
	
	</body>
</html>
		