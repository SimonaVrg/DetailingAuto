<!DOCTYPE HTML>

<html>
	<head>
	<link rel="stylesheet"href="prevAndTopBCSS.css">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
				
		<link rel="stylesheet"href="smallGalleryCSS.css">
		 <link rel="stylesheet" href="galerieFCSS.css">

		<title>Galerie</title>
		
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
			echo'<a href="signIn.php?mailUser='.$mailUser.'"> Mă Înregistrez</a>';
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
	<h2>Galerie</h2>
</div>
	
<div class="gallery"> 
<?php
	$files = glob("images/slideshow/*[.jpg|.JPG|.PNG|.JPEG]");
	for ($i=0; $i<count($files); $i++){
			$image = $files[$i];
			echo '<img src="images/slideshow/'.basename($image).'" onclick="openModal();currentSlide('.($i+1).')" class="hover-shadow cursor">';
	}
?>

</div>

<div id="myModal" class="modal">
  <span class="close cursor" onclick="closeModal()">&times;</span>
  <div class="modal-content">
	
	
	<?php
	for ($i=0; $i<count($files); $i++){
		$image = $files[$i];
			echo'<div class="mySlides">';
				echo'<div class="numbertext">'.($i+1).' / '.count($files).'</div>';
				echo'<img class="slideshow" src="images/slideshow/'.basename($image).'">';
			echo'</div>';
	}
?>
	
<!--
    <div class="mySlides">
      <div class="numbertext">1 / 4</div>
      <img class="slideshow" src="foto/3.JPG">
    </div>

    <div class="mySlides">
      <div class="numbertext">2 / 4</div>
      <img class="slideshow" src="foto/5.JPG">
    </div>

    <div class="mySlides">
      <div class="numbertext">3 / 4</div>
      <img class="slideshow" src="foto/7.JPG">
    </div>
    
    <div class="mySlides">
      <div class="numbertext">4 / 4</div>
      <img class="slideshow" src="foto/9.JPG" >
    </div>
-->
	
    <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
    <a class="next" onclick="plusSlides(1)">&#10095;</a>

<div id="web">
<?php

	for ($i=0; $i<count($files); $i++){
		$image = $files[$i];
			echo'<div class="column">';
				echo'<img class="demo cursor" src="images/slideshow/'.basename($image).'"style="width:100%" onclick="currentSlide('.($i+1).')">';
			echo'</div>';
	}
?>
</div>
<!--
    <div class="column">
      <img class="demo cursor" src="foto/3.JPG" style="width:100%" onclick="currentSlide(1)" alt="Nature and sunrise">
    </div>
    <div class="column">
      <img class="demo cursor" src="foto/5.JPG" style="width:100%" onclick="currentSlide(2)" alt="Snow">
    </div>
    <div class="column">
      <img class="demo cursor" src="foto/7.JPG" style="width:100%" onclick="currentSlide(3)" alt="Mountains and fjords">
    </div>
    <div class="column">
      <img class="demo cursor" src="foto/9.JPG" style="width:100%" onclick="currentSlide(4)" alt="Northern Lights">
    </div>
	
	-->
  </div>
</div>

<script>
function openModal() {
  document.getElementById("myModal").style.display = "block";
}

function closeModal() {
  document.getElementById("myModal").style.display = "none";
}

var slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
  showSlides(slideIndex += n);
}

function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("demo");
  var captionText = document.getElementById("caption");
  if (n > slides.length) {slideIndex = 1}
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";
  }
  for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";
  dots[slideIndex-1].className += " active";
  captionText.innerHTML = dots[slideIndex-1].alt;
}
</script>

			
	</body>
</html>



