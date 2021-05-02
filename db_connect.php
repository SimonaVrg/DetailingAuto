<?php
// 4 variables to connect to the database monitorizare
$host = "localhost";
$username = "root";
$user_pass = "usbw";
$database_in_use = "detailingauto";

// create a database connection instance  and check connection

$conn = new mysqli($host, $username, $user_pass, $database_in_use);

if($conn->connect_error){
		die("Connection failed : ". $conn->connect_error);
	}
	else{
		//echo "Successful connection to the database!<br>";
		
	}
?>