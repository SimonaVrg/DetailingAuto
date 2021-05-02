<!DOCTYPE>
<html>
	<head>
		
		<link rel="stylesheet"href="prevAndTopBCSS.css">
		<link rel="stylesheet" href="aboutServicesCSS.css">
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
	
		echo'<div class="titlu">
			<h2>Servicii Oferite</h2>
		</div>';
		
	echo'<div class="vizServ">';
		echo'<div class="serviciu">';
				echo'<div class="imagine">';
						
						echo'<img src="images/servicii/2.jpg">';
				echo'</div>';
				
				echo'<div class="descriere">';
					
				echo'Polish faruri<br>
Deși este un aspect deseori neglijat, claritatea farurilor este un detaliu 
care face diferența semnificativ.
Considerăm că siguranța este pe primul loc, iar vizibilitatea pe timp 
de noapte nu ar trebui să fie redusă de farurile neîngrijite corespunzător 
iar recondiționarea/polisharea farurilor este o soluție rapidă, eficientă
 și mult mai puțin costisitoare decât înlocuirea acestora.';

				echo'</div>';
				
				echo'<div class="pret">';
					echo '150 RON';
				echo'</div>';
		echo'</div>';
		echo'<div class="serviciu">';
				echo'<div class="imagine">';
						echo'<img src="images/servicii/recPsJ.jpg">';
				echo'</div>';
				
				echo'<div class="descriere">';
					
					echo'Recondiționare polish și jante<br>
Întreținerea jantelor este un procedeu ce ar trebui realizat constant, 
pentru ca stratul exterior de vopsea al acestora să nu sufere daune majore. 
Curățarea se face atât pe exterior, cât și pe interior, nu doar superficial, 
folosind soluții și echipamente profesionale special concepute și le pregătește
 pentru un ultim pas în care se aplică un strat fin de ceară pentru un rezultat de efect. 
În acest fel, garantăm că jantele mașinii tale vor arăta ca noi!';

				echo'</div>';
				
				echo'<div class="pret">';
					echo '450 RON';
				echo'</div>';
		echo'</div>';
		echo'<div class="serviciu">';
				echo'<div class="imagine">';
					echo'<img src="images/servicii/cauciucuri.png">';
						
				echo'</div>';
				
				echo'<div class="descriere">';
				echo'Dressing cauciucuri<br>
Pe lâgă faptul că anvelopele corespunzător îngrijite vă țin în siguranță, ele pot avea, 
de asemenea, un impact deosebit asupra aspectului mașinii dumneavoastră. 
Atunci când au nevoie de atenție, vă recomandăm să le aduceți în service-ul nostru 
autorizat, unde , după o examinare atentă, vor fi recondiționate numai de experți, 
pentru că siguranța dumneavoastră este prioritatea noastră. ';

				echo'</div>';
				
				echo'<div class="pret">';
					echo '100 RON';
				echo'</div>';
		echo'</div>';
		echo'<div class="serviciu">';
				echo'<div class="imagine">';
						echo'<img src="images/servicii/tapiterieAuto.jpg">';
				echo'</div>';
				
				echo'<div class="descriere">';
				
					echo'Curățare tapițerie auto<br>
Tapițeria banchetei și a scaunelor
In timp, din cauza uzarii intensive, tapiteria banchetei si a scaunelor se deteriorează si/sau se pateaza din cauze accidentale.
După cum știți, ne dorim ce este mai bun pentru mașina ta, așa că de curățarea și întreținerea tapițeriei se vor ocupa numai specialiști, deoarece, desi poate părea banal, această operațiune implică atât cunoașterea detaliată a texturilor și fibrelor, cât și a produselor și procedurilor ce trebuiesc aplicate în fiecare caz aparte, pentru a obține un rezultat care să ne facă mândri și de care Tu să te bucuri.
';
				echo'</div>';
				
				echo'<div class="pret">';
					echo '250 ron';
				echo'</div>';
		echo'</div>';
		echo'<div class="serviciu">';
				echo'<div class="imagine">';
							echo'<img src="images/servicii/portbagaj.jpeg">';
				echo'</div>';
				
				echo'<div class="descriere">';
					
			echo'		Curățare portbagaj<br>
Când vrem să ne reîmprospătăm mașina, o greșeală pe care o facem deseori este aceea că uităm să ne curățăm în profunzime portbagajul. Acesta este locul în care se adună mulți microbi de la diferite lucruri pe care obisnuim să le transportăm, dar și multe mirosuri neplăcute, iar un simplu odorizant de mașină nu este eficient, deoarece acesta doar va acoperi mirosul, dar nu îl va și înlătura.
Alege să adaugi pe lista de lucruri de făcut și curățarea portbagajului, diferența o vei simți imediat!
';
				echo'</div>';
				
				echo'<div class="pret">';
					echo '100 RON';
				echo'</div>';
		echo'</div>';
		echo'<div class="serviciu">';
				echo'<div class="imagine">';
					echo'<img src="images/servicii/portiere.jpg">';
				echo'</div>';
				
				echo'<div class="descriere">';

			echo'		Curățare fețe de portieră<br>

Este doar o chestiune de timp până când semnele de uzură să înceapă să apară atunci când folosim un lucru, iar fețele de la portierele mașinii din păcate nu fac excepție. Cum pentru fiecare problemă există și o soluție, noi suntem aici pentru a face mașina ta să arate ca nouă, folosind doar soluții profesionale! 
';
				echo'</div>';
				
				echo'<div class="pret">';
					echo '100 RON';
				echo'</div>';
		echo'</div>';
	echo '</div>';
		?>	
			
						
						
	
		</div>  <!--sf div gestPretServ-->
	
	</body>
</html>
		