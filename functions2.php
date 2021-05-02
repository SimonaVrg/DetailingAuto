
<?php
	
	function email_inDB($email){
		include "db_connect.php";
		//$sql = "SELECT * FROM client WHERE mailCl = '$email'";
		$sql= "SELECT mailCl FROM client WHERE mailCl='$email'
				UNION
				SELECT mailAng FROM angajat WHERE mailAng='$email'";

		$result = $conn->query($sql);
		if($result->num_rows >0) {
			//echo "This email exists in the database.<br>";
			return true;
		}
		else{
			//echo "This email does not exist in the database.";
			return false;
		}
	}
	
	function codVoucher_inDB($codVoucher){
		//echo 'Suntem in codVoucher_inDB';
		include "db_connect.php";
		$sql= "SELECT * FROM voucher WHERE codVoucher='$codVoucher'";
		$result = $conn->query($sql);
		if($result->num_rows >0) {
			return true;
		}
		else{
		//	echo "This voucher does not exist in the database.";
		return false;
		}
	}
	
	function codVoucher_inDB_withDates($codVoucher){
		//echo 'Suntem in coduripromo_inDB';
		//functie pentru coduripromo cu data de inceput si sfarsit
		include "db_connect.php";
		$sql= "SELECT * FROM coduripromo WHERE codVoucher='$codVoucher'";
		$result = $conn->query($sql);
		if($result->num_rows >0) {
			return true;
		}
		else{
		//	echo "This voucher does not exist in the database.";
		return false;
		}
	}
	
	function deleteCodVoucher_withDates($codVoucher){
		//echo 'Suntem in deleteCodVoucher_withDates';
		//functie pentru coduripromo cu data de inceput si sfarsit
		include "db_connect.php";
	
		$sql="DELETE FROM coduripromo WHERE codVoucher='$codVoucher'";

		if($conn->query($sql) === TRUE){
			echo "Codul a fost anulat!";
			/*header("Location:gestPromotii.php?mailUser=$mailUser");*/
		}
		else{
			echo "Error: ".$sql."<br>".$conn->error;
			}
		$conn->close();
					
					
	}
	
	
	
	function nrTel_inDB($nrTel){
		include "db_connect.php";
		//$sql = "SELECT * FROM client WHERE mailCl = '$email'";
		$sql= "SELECT nrTelCl FROM client WHERE nrTelCl='$nrTel'
				UNION
				SELECT nrTelAng FROM angajat WHERE nrTelAng='$nrTel'";

		$result = $conn->query($sql);
		if($result->num_rows >0) {
			//echo "This phone number exists in the database.<br>";
			return true;
		}
		else{
			//echo "This phone number does not exist in the database. It's fine ";
			return false;
		}
	}
	
	function serviciu_inDB($numeServ){
		include "db_connect.php";
		$sql = "SELECT * FROM servicii WHERE numeServ = '$numeServ'";
		$result = $conn->query($sql);
		if($result->num_rows >0) {
			//echo 'Acest serviciu exista deja in baza de date.<br>';
			return true;
		}
		else{
			//echo 'Serviciul'.$numeServ.' nu exista in baza de date.<br> ';
			return false;
		}
	}
	
	function correct_password($email,$parola){
		include "db_connect.php";
		$token=getToken($email);
			if ($token == 1 or $token == 0){
				//seful(tk=1) si angajatii(tk=0) au datele in acelasi tabel
				$sql = "SELECT * FROM angajat WHERE mailAng = '$email' && parolaAng = '$parola'";
		
			}
			else{
				if ($token == -1){
					//echo $email.' ,you are now logged in as client '.$token.'<br>';
					$sql = "SELECT * FROM client WHERE mailCl = '$email' && parolaCl = '$parola'";
		
				}
			}
		$result= $conn->query($sql);
		if ($result->num_rows > 0){
			//echo "Your password is correct!<br>";
			return true;
		}
		// passwords incorrect
		//echo "Parola curenta gresita!<br>";
		return false;
	}
	
	function identical_passwords($parolaCl,$confParCl){
		include "db_connect.php";
		if ($parolaCl != $confParCl){
			// error matching passwords
			//echo 'Noua parola nu e confirmata. Scrieti cu grija.<br>';
			return false;
		}else{
			// passwords match
			//echo 'Passwords match!<br>';
			return true;
		}
	}
	
	
	function getToken($email){
		include "db_connect.php";
		$sql= "SELECT tokenCl  AS token FROM client WHERE mailCl='$email'
				UNION
				SELECT tokenAng  AS token FROM angajat WHERE mailAng='$email'";

		$result = $conn->query($sql);
		if($result->num_rows >0) {
			$row = $result->fetch_assoc();
			//echo 'Email-ul '.$email.' are token '.$row[token].'<br>';
			return $row[token];
		}
		else{
			//echo "Some error while fetching token.";
		return false;
		}
	}
	
	function logInValidate($email,$parola){
		//echo "Am intrat in logInValidate";
		include "db_connect.php";
		if (email_inDB($email) && correct_password($email,$parola)){
			//echo 'email and password match.<br>';
			return true;
		}
		else{
			//echo 'Error connecting User!';
			return false;
		}
	}
	
	function signInValidate($email,$parolaCl,$confParCl){
		include "db_connect.php";
		if (email_inDB($email)==false && identical_passwords($parolaCl,$confParCl)){
			//echo 'email and password are valid.';
			return true;
		}
		else{
			//echo 'Error Registering User!';
			return false;
		}
	}
		
	
	/*
	function check_available_date($dataProgr){
		include "db_connect.php";
		$sql="SELECT idAng 
			FROM angajat
			WHERE tokenAng = 0 AND idAng NOT IN (
			SELECT idAng FROM zileLibere WHERE ziLibera = '$dataProgr' )";
		//pt progr avem nevoie de token=0 -inseamna angajat care se ocupa de comenzi; token=1 sef
		$result = $conn->query($sql);
		if($result->num_rows > 0) {
			$row = $result->fetch_assoc();
			//echo 'Data este disponibila';
			return true;
		}
		else{
			//echo 'Data'.$dataProgr.' nu este disponibila ';
			return false;
		}
	}
	*/
	function check_available_employee2($dataProgr){
		include "db_connect.php";
		$sql="SELECT idAng 
		FROM angajat
		WHERE tokenAng = 0 
        AND idAng NOT IN (
        	SELECT idAng FROM zileLibere WHERE ziLibera = '$dataProgr')
				AND idAng NOT IN (
					SELECT idAng FROM  programare WHERE dataProg = '$dataProgr')
		ORDER BY RAND()
		LIMIT 1";  
		$result = $conn->query($sql);
		if($result->num_rows > 0){
		//daca sunt angajati care sunt la munca in ziua resp si nu au nici o programare
		//selecteaza random un idAng care nu are nici o programare pt data respectiva
			$row = $result->fetch_assoc();
			$idAng= $row["idAng"];
			//echo '<br>$idAng (0 progr)='.$idAng;
			return $idAng;
		}
		else{ //daca sunt angajati care sunt la munca in ziua resp si au <3 programari
			//selecteaza angajatul care are cele mai putine programari din ziua respectiva
			$sql1="SELECT idAng, COUNT(*)
				FROM  programare WHERE dataProg= '$dataProgr' 
				GROUP BY idAng
				HAVING COUNT(*) < 3
			ORDER BY COUNT(*)
			LIMIT 1";
			$result1 = $conn->query($sql1);
			if($result1->num_rows > 0) { //daca exista un ang la munca si are <3 programari
				$row = $result1->fetch_assoc();
				$idAng= $row["idAng"];
				echo '<br>$idAng (>0 progr)='.$idAng;
				return $idAng;
			}
			else{
				echo 'Toti angajatii au deja programul incarcat.';
				return false;
			}
		}
			
	}
	
	function disp_voucher($email,$codVoucher){ //disponibilitate_voucher
		//cand clientul creeaza o programare noua, trebuie sa fie "disponibil"
		//cand clientul editeaza o programare, trebuie sa fie ori "disponibil", ori idProgr (adica $disp)
		include "db_connect.php";
		//$email=$_GET['email'];
		$sql = "SELECT disponibilitate FROM voucher WHERE mailCl = '$email' && codVoucher = '$codVoucher' ";
		$result = $conn->query($sql);
	
		
		if($result->num_rows > 0) {
			//echo "Voucherul '.$codVoucher.' exista pentru '.$email.'.<br>";
			//
			$row = $result->fetch_assoc();
			$disp = $row["disponibilitate"];
			//echo 'disponibilitate cod '.$codVoucher.': '.$disp.'<br>';
			return $disp; //returneaza ori "disponibil", ori "$idProgr"
		}
		else{
			//echo 'Codul promotional '.$codVoucher.' nu exista pentru '.$email.'!<br>';
			return "indisponibil";
		}
	}

	
	function update_disp_voucher_to_fol($email,$codVoucher){
		include "db_connect.php";
		$sql="UPDATE voucher SET disponibilitate='folosit' WHERE mailCl='$email' && codVoucher='$codVoucher'";
		if($conn->query($sql) === TRUE){
			$sql2="SELECT disponibilitate FROM voucher WHERE mailCl='$email' && codVoucher='$codVoucher'";
			$result= $conn->query($sql2);
			$row = $result->fetch_assoc();
			$disp_n=$row["disponibilitate"];
			//echo 'Disponibilitatea '.$codVoucher.' a fost actualizata in '.$disp_n.'cu succes!';
		}
		else{
			echo "Error: ".$sql."<br>".$conn->error;
		}
		$conn->close();
	}
	
	function update_disp_voucher_to_disp($email,$codVoucher){
		include "db_connect.php";
		$sql="UPDATE voucher SET disponibilitate='disponibil' WHERE mailCl='$email' && codVoucher='$codVoucher'";
		if($conn->query($sql) === TRUE){
			$sql2="SELECT disponibilitate FROM voucher WHERE mailCl='$email' && codVoucher='$codVoucher'";
			$result= $conn->query($sql2);
			$row = $result->fetch_assoc();
			$disp_n=$row["disponibilitate"];
			//echo 'Disponibilitatea '.$codVoucher.' a fost actualizata in '.$disp_n.'cu succes!';
		}
		else{
			echo "Error: ".$sql."<br>".$conn->error;
		}
		$conn->close();
	}
	
	function update_status_to_fin($idProg){
		//echo'Suntem in update_status_to_fin<br>';
		include "db_connect.php";
		$sql="UPDATE programare SET statusProg='Finalizata' WHERE idProg='$idProg'";
		if($conn->query($sql) === TRUE){
			$sql2="SELECT statusProg FROM programare WHERE idProg='$idProg'";
			$result= $conn->query($sql2);
			$row = $result->fetch_assoc();
			$status=$row["statusProg"];
			//echo 'Statusul progr cu id '.$idProg.' a fost actualizata in '.$status.'cu succes!';
		}
		else{
			echo "Error: ".$sql."<br>".$conn->error;
		}
		$conn->close();
	}
	
	function update_status_to_acc($idProg){
		//echo'Suntem in update_status_to_acc<br>';
		include "db_connect.php";
		$sql="UPDATE programare SET statusProg='Acceptata' WHERE idProg='$idProg'";
		if($conn->query($sql) === TRUE){
			$sql2="SELECT statusProg FROM programare WHERE idProg='$idProg'";
			$result= $conn->query($sql2);
			$row = $result->fetch_assoc();
			$status=$row["statusProg"];
		//	echo 'Statusul progr cu id '.$idProg.' a fost actualizata in '.$status.'cu succes!';
		}
		else{
			echo "Error: ".$sql."<br>".$conn->error;
		}
		$conn->close();
	}
	
	function update_status_to_anulata($idProg){
		//echo'Suntem in update_status_to_anulata<br>';
		include "db_connect.php";
		$sql="UPDATE programare SET statusProg='Anulata' WHERE idProg='$idProg'";
		if($conn->query($sql) === TRUE){
			$sql2="SELECT statusProg FROM programare WHERE idProg='$idProg'";
			$result= $conn->query($sql2);
			$row = $result->fetch_assoc();
			$status=$row["statusProg"];
			//echo 'Statusul progr cu id '.$idProg.' a fost actualizata in '.$status.'cu succes!';
		}
		else{
			echo "Error: ".$sql."<br>".$conn->error;
		}
		$conn->close();
	}
	
	function update_pret_servicii($idServ,$pret){
		//echo'Suntem in update_pret_serv<br>';
		include "db_connect.php";
		$sql="UPDATE servicii SET pretServ='$pret' WHERE idServ='$idServ'";
		if($conn->query($sql) === TRUE){
			$sql2="SELECT pretServ FROM servicii WHERE idServ='$idServ'";
			$result= $conn->query($sql2);
			$row = $result->fetch_assoc();
			$pret_n=$row["pretServ"];
			//echo 'Pretul serv " '.$numeServ.' "a fost actualizat in '.$pret_n.' cu succes!';
		}
		else{
			echo "Error: ".$sql."<br>".$conn->error;
		}
		$conn->close();
	}
	
	function update_pret_pretserv($idServ,$idTip,$pret){
		//echo'Suntem in update_pret_serv<br>';
		include "db_connect.php";
		$sql="UPDATE pretserv SET pretServ='$pret' WHERE idServ='$idServ' AND idTip='$idTip'";
		if($conn->query($sql) === TRUE){
			
			//echo 'Pretul serv " '.$numeServ.' "a fost actualizat in '.$pret_n.' cu succes!';
		}
		else{
			echo "Error: ".$sql."<br>".$conn->error;
		}
		$conn->close();
	}
	
	function update_nume_tipCaroserie($idTip,$nume){
		//echo'Suntem in update_pret_serv<br>';
		include "db_connect.php";
		$sql="UPDATE tipcaroserie SET numeTip='$nume' WHERE idTip='$idTip'";
		if($conn->query($sql) === TRUE){
			//echo 'Pretul serv " '.$numeServ.' "a fost actualizat in '.$pret_n.' cu succes!';
		}
		else{
			echo "Error: ".$sql."<br>".$conn->error;
		}
		$conn->close();
	}
	
	function update_marca_model_masini($idMasina,$marca,$model){
		//echo'Suntem in update_marca_model_masini<br>';
		include "db_connect.php";
		$sql="UPDATE masini SET marca='$marca', model='$model' WHERE idMasina='$idMasina'";
		if($conn->query($sql) === TRUE){
			//echo 
		}
		else{
			echo "Error: ".$sql."<br>".$conn->error;
		}
		$conn->close();
	}
	
	function set_displayForClient_hide($idProg){
		//echo'Suntem in set_displayForClient_hide<br>';
		include "db_connect.php";
		$sql="UPDATE programare SET displayForClient='hide' WHERE idProg='$idProg'";
		if($conn->query($sql) === TRUE){
			/*$sql2="SELECT pretServ FROM serviciu WHERE numeServ='$numeServ'";
			$result= $conn->query($sql2);
			$row = $result->fetch_assoc();
			$pret_n=$row["pretServ"];*/
			//echo 'displayForClient a fost schimbat in hide cu succes!';
		}
		else{
			echo "Error: ".$sql."<br>".$conn->error;
		}
		$conn->close();
	}
	
	
	function delete_serv($idServ){
		//echo'Suntem in delete_serv<br>';
		include "db_connect.php";
		$sql="DELETE FROM serviciu WHERE idServ='$idServ'";
		if($conn->query($sql) === TRUE){
			echo 'Am sters serv cu id '.$idServ.'!<br>';
		}
		else{
			echo "Error: ".$sql."<br>".$conn->error;
		}
		$conn->close();
	}
	
	function delete_tipCaroserie($idTip){
		
		include "db_connect.php";
		$sql="DELETE FROM tipcaroserie WHERE idTip='$idTip'";
		if($conn->query($sql) === TRUE){
			//echo 'Am sters tipC cu id '.$idTip.'!<br>';
		}
		else{
			echo "Error: ".$sql."<br>".$conn->error;
		}
		$conn->close();
	}
	function delete_masina($idMasina){
		
		include "db_connect.php";
		$sql="DELETE FROM masini WHERE idMasina='$idMasina'";
		if($conn->query($sql) === TRUE){
			//echo 'Am sters 
		}
		else{
			echo "Error: ".$sql."<br>".$conn->error;
		}
		$conn->close();
	}
	
	
	function update_nume_serv($numeServ,$nume_n){
		//echo'Suntem in update_nume_serv<br>';
		include "db_connect.php";
		$sql="UPDATE servicii SET numeServ='$nume_n' WHERE numeServ='$numeServ'";
		if($conn->query($sql) === TRUE){
			echo 'Numele serv " '.$numeServ.' "a fost actualizat in '.$nume_n.' cu succes!';
		}
		else{
			echo "Error: ".$sql."<br>".$conn->error;
		}
		$conn->close();
	}
	
	
/////////////
	function get_idCl_by_emailCl($email){
		include "db_connect.php";
		$sql = "SELECT idCl FROM client WHERE mailCl ='$email'";
			$result= $conn->query($sql);
			$row = $result->fetch_assoc();
			$idCl=$row["idCl"];
		return $idCl;
	}
	
	
	function get_mailCl_by_idCl($idCl){
		include "db_connect.php";
		$sql = "SELECT mailCl FROM client WHERE idCl ='$idCl'";
			$result= $conn->query($sql);
			$row = $result->fetch_assoc();
			$mailCl=$row["mailCl"];
		return $mailCl;
	}
	
	
	
	function get_numeAng_by_idAng($idAng){
		include "db_connect.php";
		$sql = "SELECT numeAng FROM angajat WHERE idAng ='$idAng'";
			$result= $conn->query($sql);
			$row = $result->fetch_assoc();
			$numeAng=$row["numeAng"];
		return $numeAng;
	}
	
	function get_procent_by_codVoucher($codVoucher){
		include "db_connect.php";
		$sql = "SELECT procent FROM coduripromo WHERE codVoucher ='$codVoucher'";
			$result= $conn->query($sql);
			$row = $result->fetch_assoc();
			$procent=$row["procent"];
		return $procent;
	}
	
	function get_startDate_by_codVoucher($codVoucher){
		include "db_connect.php";
		$sql = "SELECT startDate FROM coduripromo WHERE codVoucher ='$codVoucher'";
			$result= $conn->query($sql);
			$row = $result->fetch_assoc();
			$startDate=$row["startDate"];
		return $startDate;
	}
	
	function get_endDate_by_codVoucher($codVoucher){
		include "db_connect.php";
		$sql = "SELECT endDate FROM coduripromo WHERE codVoucher ='$codVoucher'";
			$result= $conn->query($sql);
			$row = $result->fetch_assoc();
			$endDate=$row["endDate"];
		return $endDate;
	}
	
	
	function get_numeCl_by_idProg($idProg){
		include "db_connect.php";
		$sql = "SELECT client.numeCl
				FROM client
				INNER JOIN programare
				ON client.idCl=programare.idCl WHERE programare.idProg='$idProg'";
			$result= $conn->query($sql);
			$row = $result->fetch_assoc();
			$numeCl=$row["numeCl"];
		return $numeCl;
	}
	
	 function get_idAng_by_idProg($idProg){
		//echo'Am intrat in get';
		include "db_connect.php";
		
		$sql = "SELECT idAng FROM programare WHERE idProg = '$idProg'";
		$result = $conn->query($sql);
		if($result->num_rows > 0) {
			$row = $result->fetch_assoc();
			$idAng = $row['idAng'];
			return $idAng; //returneaza idAng
		}
		else{
			echo'Some error in function get_idAng_by_idProg';
			return false;
		}
	 }
	 
	  function get_idCl_by_idProg($idProg){
		//echo'Am intrat in get idCl ';
		include "db_connect.php";
		
		$sql = "SELECT idCl FROM programare WHERE idProg = '$idProg'";
		$result = $conn->query($sql);
		if($result->num_rows > 0) {
			$row = $result->fetch_assoc();
			$idCl = $row['idCl'];
			return $idCl; //returneaza idAng
		}
		else{
			echo'Some error in function get_idCl_by_idProg';
			return false;
		}
	 }
	 
	 
	 function get_idProgr_by_voucherFol($email,$codVoucher){
		///cautam in programari intregistrarea cu email=$email si codVoucher=$_POST['codVoucher']
		include "db_connect.php";
		$idCl=get_idCl_by_emailCl($email);
		$sql = "SELECT idProg FROM programare WHERE idCl = '$idCl' && codVoucher= '$codVoucher'";
		$result = $conn->query($sql);
		if($result->num_rows > 0) {
			$row = $result->fetch_assoc();
			$idProg = $row['idProg'];
			return $idProg; //returneaza idProg
		}
		else{
			
			return false;
		}
	 }
	  function get_codVoucher_by_idProg($idProg){
		include "db_connect.php";
		$idCl=get_idCl_by_emailCl($email);
		$sql = "SELECT codVoucher FROM programare WHERE idProg = '$idProg'";
		$result = $conn->query($sql);
		if($result->num_rows > 0) {
			$row = $result->fetch_assoc();
			$codVoucher = $row['codVoucher'];
			return $codVoucher; 
		}
	 }
	 
	 
	function get_dataProgr_by_idProg($idProg){
		//echo'Am intrat in get';
		include "db_connect.php";
		
		$sql = "SELECT dataProg FROM programare WHERE idProg = '$idProg'";
		$result = $conn->query($sql);
		if($result->num_rows > 0) {
			$row = $result->fetch_assoc();
			$dataProg = $row['dataProg'];
			return $dataProg; //returneaza idProg
		}
		else{
			echo'Some error in function get_dataProgr_by_idProg';
			return false;
		}
	 }
	
	function get_review_by_idProg($idProg){
		//echo'Am intrat in get_review';
		include "db_connect.php";
		
		$sql = "SELECT review FROM review WHERE idProg = '$idProg'";
		$result = $conn->query($sql);
		if($result->num_rows > 0) {
			$row = $result->fetch_assoc();
			$review = $row['review'];
			return $review; //returneaza review
		}
		else{
			//echo 'Nu exista review pt programare';
			return false;
		}
	}
	
	function get_displayNume_by_idProg($idProg){
		include "db_connect.php";
		$sql = "SELECT displayNume FROM review WHERE idProg = '$idProg'";
		$result = $conn->query($sql);
		if($result->num_rows > 0) {
			$row = $result->fetch_assoc();
			$displayNume = $row['displayNume'];
			return $displayNume; //returneaza displayNume
		}
		else{
			//echo 'Nu exista review pt programare';
			return false;
		}
	}
	
	
	
	function status_progr($idProg){
		include "db_connect.php";
		//$idCl=get_idCl_by_emailCl($email);
		//$sql = "SELECT statusProg FROM programare WHERE idCl = '$idCl' && idProg= '$idProg'";
		$sql = "SELECT statusProg FROM programare WHERE idProg= '$idProg'";
		$result = $conn->query($sql);
		if($result->num_rows > 0) {
			$row = $result->fetch_assoc();
			$status = $row['statusProg'];
			//echo '$status: '.$status;
			return $status; //returneaza ori "Finalizata", ori "Acceptata"
		}
		else{
			//echo 'Nu exista o programare cu ID='.$idProg;
			return false;
		}
	}
	function exista_ziLibera($idAng, $ziLibera){
		include "db_connect.php";
		//echo 'Suntem in exista_ziLibera<br>';
		
		$sql = "SELECT * FROM zilelibere WHERE idAng = '$idAng' && ziLibera= '$ziLibera'";
		$result = $conn->query($sql);
		if($result->num_rows > 0) {
			return true;
		}
		else{
			return false;
		}
	}
	
	function exista_programare($email,$idProg){
		include "db_connect.php";
		//echo 'Suntem in exista_programare<br>';
		$idCl=get_idCl_by_emailCl($email);
		$sql = "SELECT * FROM programare WHERE idCl = '$idCl' && idProg= '$idProg'";
		$result = $conn->query($sql);
		if($result->num_rows > 0) {
			return true;
		}
		else{
			//echo 'Nu exista o programare cu ID='.$idProg.' pentru '.$email;
			return false;
		}
	}
	
	function delete_voucher($email,$codVoucher){
		//echo'Suntem in delete_voucher<br>';
		include "db_connect.php";
		$sql = "DELETE FROM voucher WHERE mailCl='$email' && codVoucher='$codVoucher'";

		if($conn->query($sql) === TRUE){
			//echo 'Codul voucher '.$codVoucher.'a fost sters pentru '.$email.'!<br>';
		}
		else{
		echo "Error: ".$sql."<br>".$conn->error;
		}
		$conn->close();
	}
	
	
	function add_codVoucher_inDB($codVoucher){
		//echo'Suntem in add_codVoucher_inDB<br>';
		include "db_connect.php";
		
		$sql="SELECT mailCl FROM client";
		$result = $conn->query($sql);
		if($result->num_rows > 0) { 
			while($row = $result->fetch_assoc()) { 
				$mailCl=$row["mailCl"];
				$sql2 = "INSERT INTO voucher (mailCl,codVoucher,disponibilitate) 
								VALUES ('$mailCl','$codVoucher','disponibil')";

				if($conn->query($sql2) === TRUE){
					echo "Codul promotional a fost adaugat cu succes!";
				}
				else{
				echo "Error: ".$sql2."<br>".$conn->error;
				}
			}
		}
		$conn->close();
	}
	
	
	function add_codVoucher_inDB_withDates($codVoucher,$procent,$startDate,$endDate){
		//echo'Suntem in add_codVoucher_inDB_withDates<br>';
		include "db_connect.php";
		
		$sql = "INSERT INTO coduripromo (codVoucher, procent, startDate, endDate) 
						VALUES ('$codVoucher','$procent','$startDate','$endDate')";

		if($conn->query($sql) === TRUE){
			echo "Codul a fost adaugat cu succes IN add_codVoucher_inDB_withDates !";
		}
		else{
		echo "Error: ".$sql."<br>".$conn->error;
		}
		
		
		$conn->close();
	}
	
	
	function add_serv_inDB($numeServ,$pretServ){
		//echo'Suntem in add_serv_inDB<br>';
		include "db_connect.php";
		$sql = "INSERT INTO servicii (numeServ,pretServ) 
						VALUES ('$numeServ','$pretServ')";

		if($conn->query($sql) === TRUE){
			echo "Serviciul a fost adaugat cu succes!";
		}
		else{
		echo "Error: ".$sql."<br>".$conn->error;
		}
		$conn->close();
	}
	
	
	function add_serv_pretserv($idServ){
	//echo'Suntem in add_serv_inDB<br>';
	include "db_connect.php";
	//pentru toate tipurile de tip caroserie, introducem pretul 0 in tabelul pretserv
	
	$sql = "INSERT INTO pretserv ( idServ, idTip, pretServ )
			SELECT  '$idServ', tipcaroserie.idTip, 0
			FROM    tipcaroserie";
		/*	
	INSERT INTO pretserv (idServ,pretServ) 
					VALUES ('$numeServ','$pretServ')";
					*/

	if($conn->query($sql) === TRUE){
		echo "Serviciul a fost adaugat cu succes!";
	}
	else{
	echo "Error: ".$sql."<br>".$conn->error;
	}
	$conn->close();
	}
	
	function add_tipCaroserie($nume){
		//echo'Suntem in add_serv_inDB<br>';
		include "db_connect.php";
		$sql = "INSERT INTO tipcaroserie (numeTip) 
						VALUES ('$nume')";

		if($conn->query($sql) === TRUE){
			//echo 
		}
		else{
		echo "Error: ".$sql."<br>".$conn->error;
		}
		$conn->close();
	}
	
	function add_marca_model($marca, $model){
		//echo'Suntem in add_serv_inDB<br>';
		include "db_connect.php";
		$sql = "INSERT INTO masini (marca,model) 
						VALUES ('$marca','$model')";

		if($conn->query($sql) === TRUE){
			//echo "Serviciul a fost adaugat cu succes!";
		}
		else{
		echo "Error: ".$sql."<br>".$conn->error;
		}
		$conn->close();
	}
	
	function add_review_inDB($idProg,$review){
		//echo'Suntem in add_review_inDB<br>';
		include "db_connect.php";
		$sql = "INSERT INTO review (idProg,review) 
						VALUES ('$idProg','$review')";

		if($conn->query($sql) === TRUE){
			//echo 'Review adaugat cu succes!';
		}
		else{
		echo "Error: ".$sql."<br>".$conn->error;
		}
		$conn->close();
	}
	
	function check_review($review){
		//vrem ca un review sa aiba cel putin 5 caractere diferite de "_space_"		
		$count = 0;
		$nr_caractere= strlen($review);
		//echo 'nr caractere:'.$nr_caractere.'<br>';
	//	while($count <= 5){  
			//verficam lungimea sirului si verificam fiecare caracter pana gasim 5 caractere diferite de "_space_"
			while ($nr_caractere > 0 ){
				$caracter = $review[$nr_caractere-1];
			//	echo 'caracter:'.$caracter.'<br>';
				if ($caracter != " "){
					
						$count=$count+1;
						//	echo 'count:'.$count.'<br>';
					}
				if($count == 5){
					return 1;
				}
				$nr_caractere = $nr_caractere - 1;
			}
		//}
		
		if($count < 5){
			return 0;
		}
	}
		
	function redistr_progr_pt_o_zi($idAng,$ziLibera){
		//folosim functia cand vrem sa adaugam o zi libera unui angajat si trebuie sa redistribuim toate programarile lui din acea zi
		include "db_connect.php";
		$sql = "SELECT idProg FROM programare WHERE idAng = '$idAng' && dataProg = '$ziLibera'";
		$result = $conn->query($sql);
		if($result->num_rows > 0) { //daca $idAng are programari pentru data '.$ziLibera.'
			while($row = $result->fetch_assoc()) { //ia fiecare progr si incearca sa gaseasca un angajat disponibil pt $ziLibera care sa preia
				$idProg=$row["idProg"];
				
				//echo 'Angajatul are programarea cu id: '.$row["idProg"].'.<br>';	
				
				if (reassign_employee2($ziLibera,$idAng)!=false){
					$idAng_nou=reassign_employee2($ziLibera,$idAng);
					echo 'Noul angajat:'.$idAng_nou.'<br>';
					update_idAng($idProg, $idAng_nou);
				}else{
					echo'Nu sunt angajati disponibili pentru data '.$ziLibera.'. Anulam programarea. <br>';
						update_status_to_anulata($idProg);
				}
			}
		}
		else{
			echo 'Angajatul cu id'.$idAng.' nu are programari nefinalizate ';
		}
	}
	
	function redistr_progr($idAng){
		//folosim functia cand vrem sa stergem un angajat si trebuie sa redistribuim toate programarile lui viitoare
		include "db_connect.php";
		$today=date('Y-m-d');
		$sql = "SELECT idProg, dataProg FROM programare WHERE idAng = '$idAng' && dataProg >='$today'";
		$result = $conn->query($sql);
		if($result->num_rows > 0) { //daca $idAng are programari viitoare
			while($row = $result->fetch_assoc()) { //ia fiecare progr viitoare si incearca sa gaseasca un angajat disponibil pt dataProg care sa preia
				$idProg=$row["idProg"];
				$dataProg=$row["dataProg"];
				//echo 'Este nefinalizata programarea cu id: '.$row["idProg"].'.<br>';	
				
				if (reassign_employee2($dataProg,$idAng)!=false){
					$idAng_nou=reassign_employee2($dataProg,$idAng);
					//echo 'Noul angajat:'.$idAng_nou.'<br>';
					update_idAng($idProg, $idAng_nou);
				}else{
					//echo'Nu sunt angajati disponibili pentru data '.$dataProg.'. Anulam programarea. <br>';
						
						update_status_to_anulata($idProg);
						
				}
			}
		}
		else{
			echo 'Angajatul cu id'.$idAng.' nu are programari nefinalizate ';
		}
	}
	
	function reassign_employee2($dataProgr,$idAngDeSters){
		//cauta sa distribuie o programare unui angajat, mai putin $idAngDeSters
		//returneaza id-ul unui angajat care poate prelua o programare intr-o zi $dataProg
		//daca nu exista nici un angajat disponibil, returneaza false
		include "db_connect.php";
		$sql="SELECT idAng 
		FROM angajat
		WHERE tokenAng = 0
		AND idAng!='$idAngDeSters'
        AND idAng NOT IN (
        	SELECT idAng FROM zileLibere WHERE ziLibera = '$dataProgr')
				AND idAng NOT IN (
					SELECT idAng FROM  programare WHERE dataProg = '$dataProgr')
		ORDER BY RAND()
		LIMIT 1";  
	
		$result = $conn->query($sql);
		if($result->num_rows > 0){
		//daca sunt angajati care sunt la munca in ziua resp si nu au nici o programare
		//selecteaza random un idAng care nu are nici o programare pt data respectiva
			$row = $result->fetch_assoc();
			$idAng= $row["idAng"];
			echo '<br>$idAng (0 progr)='.$idAng;
			return $idAng;
		}
		else{ //daca sunt angajati care sunt la munca in ziua resp si au <3 programari
			//selecteaza angajatul care are cele mai putine programari din ziua respectiva
			$sql1="SELECT idAng, COUNT(*)
				FROM  programare WHERE dataProg= '$dataProgr' 
				AND idAng!='$idAngDeSters'
				GROUP BY idAng
				HAVING COUNT(*) < 3
			ORDER BY COUNT(*)
			LIMIT 1";
			$result1 = $conn->query($sql1);
			if($result1->num_rows > 0) { //daca exista un ang la munca si are <3 programari
				$row = $result1->fetch_assoc();
				$idAng= $row["idAng"];
				echo '<br>$idAng (>0 progr)='.$idAng;
				return $idAng;
			}
			else{
				echo 'Toti angajatii au deja programul incarcat.';
				return false;
			}
		}
			
	}
	/*
	function reassign_employee($dataProgr,$idAngDeSters){ //cauta sa distribuie o programare unui angajat, mai putin $idAngDeSters
	//returneaza id-ul unui angajat care poate prelua o programare intr-o zi $dataProg
	//daca nu exista nici un angajat disponibil, returneaza false
		include "db_connect.php";
		$sql="SELECT idAng 
			FROM angajat
			WHERE tokenAng = 0 AND idAng!='$idAngDeSters' AND idAng NOT IN (  
			SELECT idAng FROM zileLibere WHERE ziLibera = '$dataProgr' )";  //mai putin angajatii care sunt liberi in acea zi
		$result = $conn->query($sql);
		if($result->num_rows > 0) { //daca sunt angajati care sunt la munca in ziua resp
			while($row = $result->fetch_assoc()) { //ia fiecare angajat si verifica nr de programari pe care le are in ziua resp
				$idAng= $row["idAng"];
				//numaram cate programari are $idAng pt data $dataProgr
				$sql3 = "SELECT * FROM programare WHERE idAng='$idAng' AND dataProg = '$dataProgr' ";
				$result3 = $conn->query($sql3);
				if($result3->num_rows < 3) {
					$row3 = $result3->num_rows;
					//echo 'Angajatul cu idAng= '.$idAng.' are doar '.$row3.'programari pentru data '.$dataProgr.'<br>';
					//echo 'Este disponibil angajatul cu id: '.$row["idAng"];
					return $idAng;
				}
			}//daca mi-a iesit din while fara sa returneze true, inseamna ca toti angajatii au deja 3 programari pt ziua respectiva	
		}
		else{//echo 'Data'.$dataProgr.' nu este disponibila ';
			return false;
		}
	}
	*/
	function update_idAng($idProg, $idAng_nou){
		//echo'Suntem in update_idAng<br>';
		include "db_connect.php";
		$sql="UPDATE programare SET idAng='$idAng_nou' WHERE idProg='$idProg'";
		if($conn->query($sql) === TRUE){
			$sql2="SELECT idAng FROM programare WHERE idProg='$idProg'";
			$result= $conn->query($sql2);
			$row = $result->fetch_assoc();
			$idAng=$row["idAng"];
			//echo 'Noul angajat pt progr cu id '.$idProg.' a fost actualizata in id:'.$idAng.'cu succes!';
		}
		else{
			echo "Error: ".$sql."<br>".$conn->error;
		}
		$conn->close();
	}
	
	function update_review($idProg,$review){
		//echo'Suntem in update_review<br>';
		include "db_connect.php";
		$sql = "UPDATE review SET review='$review' WHERE idProg='$idProg' ";
		if($conn->query($sql) === TRUE){
			//echo "Review editat cu succes!";
		}
		else{
		echo "Error: ".$sql."<br>".$conn->error;
		}
		$conn->close();
	}
	
	function update_displayNume($idProg,$display){
		include "db_connect.php";
		$sql = "UPDATE review SET displayNume='$display' WHERE idProg='$idProg' ";
		if($conn->query($sql) === TRUE){
			//echo "displayNume actualizat cu succes!";
		}
		else{
		echo "Error: ".$sql."<br>".$conn->error;
		}
		$conn->close();
	}
	
	function are_progr_anulate($idCl){
		//echo'Suntem in are_progr_anulate<br>';
		include "db_connect.php";
		$today=date('Y-m-d');
		
		$sql="SELECT dataProg FROM programare WHERE idCl='$idCl' and statusProg='Anulata' and dataProg > '$today' ORDER BY dataProg DESC ";
		$result= $conn->query($sql);
			if ($result->num_rows > 0){
				return $result->num_rows ;
			}
			else{
				return 0;
			}
		$conn->close();
	}
	
	
	
	function af_toate_progr(){
		//echo'Suntem in af_toate_progr<br>';
		include "db_connect.php";
		$sql="SELECT idProg, idCl, idMasina, dataProg,idAng,listaServicii,codVoucher, pretProg, statusProg FROM programare ORDER BY dataProg DESC";
			$result= $conn->query($sql);
			if ($result->num_rows > 0) {
		echo'<div class="vizProgr">';
			while($row = $result->fetch_assoc()) {
				$idProg=$row["idProg"];
				$dataProg= $row["dataProg"];
				$idAng= $row["idAng"];
				$listaServ= $row["listaServicii"];
				$codVoucher= $row["codVoucher"];
				$pretProg= $row["pretProg"];
				$statusProg= $row["statusProg"];
				$idMasina= $row["idMasina"];
				
					echo'<div class="'.$statusProg.'">';
					
						echo 'ID programare: '.$idProg.' <br>';
							
						if($idMasina != 0){
							$carName=get_carNameByID($idMasina);
							echo 'Masina: '.$carName.' <br>';
						}
								
						echo 'Data programare: '.$dataProg.' <br>';
						echo 'Lista servicii alese: '.$listaServ.' <br>';
						if($codVoucher!=''){
						echo 'Cod voucher folosit: '.$codVoucher.' <br>';
						}
						echo 'Pret: '.$pretProg.' <br>';
						echo 'Status: '.$statusProg.' <br>';
						
					echo'</div>';
				
			}
		echo'</div>';
			}
	}
	
	function af_progr_acc(){
		//echo'Suntem in af_progr_acc<br>';
		include "db_connect.php";
		$sql="SELECT idProg, idCl, idMasina, dataProg,idAng,listaServicii,codVoucher, pretProg, statusProg FROM programare WHERE statusProg='Acceptata' ORDER BY dataProg DESC ";
			$result= $conn->query($sql);
			if ($result->num_rows > 0) {
		echo'<div class="vizProgr">';
			while($row = $result->fetch_assoc()) {
				$idProg=$row["idProg"];
				$dataProg= $row["dataProg"];
				$idAng= $row["idAng"];
				$listaServ= $row["listaServicii"];
				$codVoucher= $row["codVoucher"];
				$pretProg= $row["pretProg"];
				$statusProg= $row["statusProg"];
				$idMasina= $row["idMasina"];
					echo'<div class="'.$statusProg.'">';
					
						echo 'ID programare: '.$idProg.' <br>';
						
						if($idMasina != 0){
							$carName=get_carNameByID($idMasina);
							echo 'Masina: '.$carName.' <br>';
						}
								
								
						echo 'Data programare: '.$dataProg.' <br>';
						echo 'Lista servicii alese: '.$listaServ.' <br>';
						if($codVoucher!=''){
						echo 'Cod voucher folosit: '.$codVoucher.' <br>';
						}
						echo 'Pret: '.$pretProg.' <br>';
						echo 'Status: '.$statusProg.' <br>';
						
					echo'</div>';
				
			}
		echo'</div>';
			}
		else{
			echo 'Nu exista nici o programare cu statusul "Acceptata".';
		}
	}
	
	
	function af_progr_amanate(){
		//echo'Suntem in af_progr_anulate<br>';
		include "db_connect.php";
		$sql="SELECT idProg, idCl, idMasina, dataProg,idAng,listaServicii,codVoucher, pretProg, statusProg FROM programare WHERE statusProg='Anulata' ORDER BY dataProg DESC ";
			$result= $conn->query($sql);
			if ($result->num_rows > 0) {
		echo'<div class="vizProgr">';
			while($row = $result->fetch_assoc()) {
				$idProg=$row["idProg"];
				$dataProg= $row["dataProg"];
				$idAng= $row["idAng"];
				$listaServ= $row["listaServicii"];
				$codVoucher= $row["codVoucher"];
				$pretProg= $row["pretProg"];
				$statusProg= $row["statusProg"];
				$idMasina= $row["idMasina"];
					echo'<div class="'.$statusProg.'">';
					
						echo 'ID programare: '.$idProg.' <br>';
							if($idMasina != 0){
							$carName=get_carNameByID($idMasina);
							echo 'Masina: '.$carName.' <br>';
						}
								
						echo 'Data programare: '.$dataProg.' <br>';
						echo 'Lista servicii alese: '.$listaServ.' <br>';
						if($codVoucher!=''){
						echo 'Cod voucher folosit: '.$codVoucher.' <br>';
						}
						echo 'Pret: '.$pretProg.' <br>';
						echo 'Status: '.$statusProg.' <br>';
						
					echo'</div>';
				
			}
		echo'</div>';
			}
		else{
			echo 'Nu exista nici o programare cu statusul "Amanata".';
		}
	}
	
	
	
	function af_progr_fin(){
		//
		//echo'Suntem in af_progr_fin<br>';
		include "db_connect.php";
		$sql="SELECT idProg, idCl,idMasina, dataProg,idAng,listaServicii,codVoucher, pretProg, statusProg FROM programare WHERE statusProg='Finalizata' ORDER BY dataProg DESC";
			$result= $conn->query($sql);
			if ($result->num_rows > 0) {
		echo'<div class="vizProgr">';
			while($row = $result->fetch_assoc()) {
				$idProg=$row["idProg"];
				$dataProg= $row["dataProg"];
				$idAng= $row["idAng"];
				$listaServ= $row["listaServicii"];
				$codVoucher= $row["codVoucher"];
				$pretProg= $row["pretProg"];
				$statusProg= $row["statusProg"];
				$idMasina= $row["idMasina"];
					echo'<div class="'.$statusProg.'">';
					
						echo 'ID programare: '.$idProg.' <br>';
						if($idMasina != 0){
							$carName=get_carNameByID($idMasina);
							echo 'Masina: '.$carName.' <br>';
						}
						echo 'Data programare: '.$dataProg.' <br>';
						echo 'Lista servicii alese: '.$listaServ.' <br>';
						if($codVoucher!=''){
						echo 'Cod voucher folosit: '.$codVoucher.' <br>';
						}
						echo 'Pret: '.$pretProg.' <br>';
						echo 'Status: '.$statusProg.' <br>';
						
					echo'</div>';
				
			}
		echo'</div>';
			}
		else{
			echo 'Nu exista nici o programare cu statusul "Finalizata".';
		}
	}
	/*
	function count_cod_folosit($codVoucher){ //numara cati clienti au folosit codul
		//suntem in function count_cod_folosit
		include "db_connect.php";
		$sql="SELECT * FROM voucher WHERE codVoucher='$codVoucher' && disponibilitate='folosit'";
		$result= $conn->query($sql);
		if($result->num_rows > 0) {
				if($result->num_rows == 1) {
					echo'Codul a fost folosit o singura data.<br>';
				}
				else{
					echo'Codul a fost folosit de '.$result->num_rows.'ori.<br>';
				}
			}
		else{
			echo 'Codul nu a fost folosit niciodata.<br>';
		}
		$conn->close();
	}
	
	function count_cod_disponibil($codVoucher){ //numara pentru cati clienti este disponibil codul
		//suntem in function count_cod_folosit
		include "db_connect.php";
		$sql="SELECT * FROM voucher WHERE codVoucher='$codVoucher' && disponibilitate='disponibil'";
		$result= $conn->query($sql);
		if($result->num_rows > 0) {
				if($result->num_rows == 1) {
					echo'Codul este disponibil pentru un singur utilizator.<br>';
			
				}
				else{
					echo'Codul este disponibil pentru '.$result->num_rows.' utilizatori.<br>';
			
				}
			}
		else{
			echo 'Codul nu mai este disponibil.';
		}
		$conn->close();
	}
	*/
	
	
	
	function count_cod($codVoucher,$disp){ //numara pentru cati clienti este disponibil/folosIT codul
	//suntem in function count_cod
	include "db_connect.php";
	$sql="SELECT * FROM voucher WHERE codVoucher='$codVoucher' && disponibilitate='$disp'";
	$result= $conn->query($sql);
	if($disp == 'disponibil'){
		if($result->num_rows > 0) {
			if($result->num_rows == 1) {
				echo'Codul este disponibil pentru un singur utilizator.<br>';
			}
			else{
				echo'Codul este disponibil pentru '.$result->num_rows.' utilizatori.<br>';
			}
		}
		else{
			echo 'Codul nu mai este disponibil.';
		}
	}
	else{
		if($result->num_rows > 0) {
			if($result->num_rows == 1) {
				echo'Codul a fost folosit o singura data.<br>';
			}
			else{
				echo'Codul a fost folosit de '.$result->num_rows.'ori.<br>';
			}
		}
	else{
		echo 'Codul nu a fost folosit niciodata.<br>';
	}
	}
	$conn->close();
	}

	function count_cod_withDates($codVoucher,$disp){ //numara pentru cati clienti este disponibil/folosIT codul
		//suntem in function count_cod
		include "db_connect.php";
		
		if($disp == 'disponibil'){
			//un cod este dispoinibil pt toti clientii care nu l-au folosit deja -> mailCl din toti client MINUS mailCl din coduripromofolosite
			
			//$sql=" select client.mailCl from client as client where client.mailCl NOT IN (select clientFol.mailCl from coduripromofolosite as clientFol ) ";
			$sql=" select client.mailCl from client as client where client.mailCl NOT IN (select clientFol.mailCl from coduripromofolosite as clientFol WHERE codVoucher='$codVoucher' ) ";
			$result= $conn->query($sql);
			
				if($result->num_rows > 0) {
					if($result->num_rows == 1) {
						echo'Codul este disponibil pentru un singur utilizator.<br>';
					}
					else{
						echo'Codul este disponibil pentru '.$result->num_rows.' utilizatori.<br>';
					}
				}
				else{
					echo 'Codul nu mai este disponibil.';
				}
		}
		else{
			$sql="SELECT * FROM coduripromofolosite WHERE codVoucher='$codVoucher' ";
			$result= $conn->query($sql);
				
			if($result->num_rows > 0) {
				if($result->num_rows == 1) {
					echo'Codul a fost folosit o singura data.<br>';
				}
				else{
					echo'Codul a fost folosit de '.$result->num_rows.'ori.<br>';
				}
			}
			else{
				echo 'Codul nu a fost folosit niciodata.<br>';
			}
		}
		$conn->close();
		}

	function exista_cod_voucher_pt_client($mailUser){
		//returneaza true / false daca un client are coduri promotionale disponibile
	//echo 'Suntem in exista_cod_voucher_pt_client';
		include "db_connect.php";
	/*	$sql= "SELECT codVoucher FROM voucher WHERE mailCl='$mailUser' && disponibilitate='disponibil'"; */
		$sql= " select cod.codVoucher from coduripromo as cod where cod.codVoucher NOT IN (select codFol.codVoucher from coduripromofolosite as codFol WHERE mailCl='$mailUser' ) ";
			
		$result = $conn->query($sql);
		if($result->num_rows >0) {
			//echo 'are coduri';
			return true;
		}
		else{
			//echo "Utilizatorul nu are coduri promotionale disponibile.";
		return false;
		}
		$conn->close();
	}
	
	function display_cod_voucher_pt_client($mailUser){
		//afiseaza codurile promotionale ale unui client
		//echo 'Suntem in display_cod_voucher_pt_client';
		include "db_connect.php";
		/*$sql= "SELECT codVoucher FROM voucher WHERE mailCl='$mailUser' && disponibilitate='disponibil'";*/
		
		$sql= " select cod.codVoucher from coduripromo as cod where cod.codVoucher NOT IN (select codFol.codVoucher from coduripromofolosite as codFol WHERE mailCl='$mailUser' ) ";
						
		$result = $conn->query($sql);
		
		if ($result->num_rows > 0) {
			echo '<b>Aveti urmatoarele coduri promotionale disponibile:</b><br>';
			while($row = $result->fetch_assoc()) {
				echo $row['codVoucher'].'<br>';
				}
		}
		$conn->close();
	}

	
	function add_ziLibera($idAng,$ziLibera){
		echo'Suntem in add_ziLibera<br>';
		include "db_connect.php";
		$sql = "INSERT INTO zilelibere (idAng,ziLibera) 
						VALUES ('$idAng','$ziLibera')";

		if($conn->query($sql) === TRUE){
			echo "Ziua libera a fost adaugata cu succes!";
		}
		else{
		echo "Error: ".$sql."<br>".$conn->error;
		}
		$conn->close();
	}
	
	function add_codpromofolosit($codVoucher, $mailCl){
		echo'Suntem in add_codpromofolosit<br>';
		include "db_connect.php";
		$sql = "INSERT INTO coduripromofolosite (codVoucher,mailCl) 
						VALUES ('$codVoucher','$mailCl')";

		if($conn->query($sql) === TRUE){
			echo "Codul promo a fost adaugat cu succes!";
		}
		else{
		echo "Error: ".$sql."<br>".$conn->error;
		}
		$conn->close();
	}
	
	function delete_codpromofolosit($codVoucher, $mailCl){
		echo'Suntem in delete_codpromofolosit<br>';
		include "db_connect.php";
		$sql = "DELETE FROM coduripromofolosite WHERE codVoucher='$codVoucher' && mailCl = '$mailCl' ";

		if($conn->query($sql) === TRUE){
			echo "Codul promo a fost sters din coduripromofolosite cu succes!";
		}
		else{
		echo "Error: ".$sql."<br>".$conn->error;
		}
		$conn->close();
	}
	
	function sterge_ziLibera($idAng,$ziLibera){
		echo'Suntem in sterge_ziLibera<br>';
		include "db_connect.php";
		$sql="DELETE FROM zilelibere WHERE idAng='$idAng' && ziLibera ='$ziLibera'";
		if($conn->query($sql) === TRUE){
			echo 'Am sters ziua libera pt ang cu id '.$idAng.'!<br>';
		}
		else{
			echo "Error: ".$sql."<br>".$conn->error;
		}
		$conn->close();
	}
	
	function delete_review($idProg){
		
		include "db_connect.php";
		$sql="DELETE FROM review WHERE idProg='$idProg'";
		if($conn->query($sql) === TRUE){
			//echo 'Am sters review pt progr cu id'.$idProg.'!<br>';
		}
		else{
			echo "Error: ".$sql."<br>".$conn->error;
		}
		$conn->close();
	}
	/*
	function del_ziLibera($idAng,$ziLibera){
		echo'Suntem in add_ziLibera<br>';
		include "db_connect.php";
		
		$sql= "SELECT * FROM zilelibere WHERE idAng='$idAng'&& ziLibera='$ziLibera'";
		$result = $conn->query($sql);
		
		if !($result->num_rows > 0) {
			echo 'Aceasta zi deja era libera';
		}else{
		
		$sql2 = "DELETE FROM zilelibere WHERE idAng='$idAng'&& ziLibera='$ziLibera'";

		if($conn->query($sql2) === TRUE){
			echo "Ziua libera a fost anulata!";
		}
		else{
		echo "Error: ".$sql."<br>".$conn->error;
		}
		$conn->close();
	}
	}	*/
	

function get_carNameByID($carID){
	include "db_connect.php";
	$sql = "SELECT marca, model FROM masini WHERE idMasina ='$carID'";
		$result= $conn->query($sql);
		$row = $result->fetch_assoc();
		$carName=$row["marca"].' '.$row["model"];
	return $carName;
}

function get_marcaMasinaByID($carID){
	include "db_connect.php";
	$sql = "SELECT marca FROM masini WHERE idMasina ='$carID'";
		$result= $conn->query($sql);
		$row = $result->fetch_assoc();
		$marcaMasina=$row["marca"];
	return $marcaMasina;
}

function get_modelMasinaByID($carID){
	include "db_connect.php";
	$sql = "SELECT model FROM masini WHERE idMasina ='$carID'";
		$result= $conn->query($sql);
		$row = $result->fetch_assoc();
		$modelMasina=$row["model"];
	return $modelMasina;
}

function get_numeServ_by_idServ($idServ){
	include "db_connect.php";
	$sql = "SELECT numeServ FROM servicii WHERE idServ ='$idServ'";
		$result= $conn->query($sql);
		$row = $result->fetch_assoc();
		$numeServ=$row["numeServ"];
	return $numeServ;
}

function get_pretStandard_by_idServ($idServ){
	include "db_connect.php";
	$sql = "SELECT pretServ FROM servicii WHERE idServ ='$idServ'";
		$result= $conn->query($sql);
		$row = $result->fetch_assoc();
		$pretServ=$row["pretServ"];
	return $pretServ;
}

function get_pret_by_idServ_tipCaroserie($idServ,$idTip){
	include "db_connect.php";
	$sql = "SELECT pretServ FROM pretserv WHERE idServ ='$idServ' AND idTip='$idTip'";
		$result= $conn->query($sql);
		$row = $result->fetch_assoc();
		$pretServ=$row["pretServ"];
	return $pretServ;
}

function get_idServ_by_numeServ($numeServ){
	include "db_connect.php";
	$sql = "SELECT idServ FROM servicii WHERE numeServ ='$numeServ'";
		$result= $conn->query($sql);
		$row = $result->fetch_assoc();
		$idServ=$row["idServ"];
	return $idServ;
}
	

function get_tipCaroserieNameByID($tipChoice){
	include "db_connect.php";
	$sql = "SELECT numeTip FROM tipcaroserie WHERE idTip ='$tipChoice'";
		$result= $conn->query($sql);
		$row = $result->fetch_assoc();
		$tipChoiceName=$row["numeTip"];
	return $tipChoiceName;
}
?>
		