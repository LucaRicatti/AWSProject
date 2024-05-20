<?php
$dbhost = "localhost";
$dbuser = "admin";
$dbpass = "password";
$dbname = "AWS";
$dbport = 3306;
$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname, $dbport);

if($conn -> error){
	echo "Connection error";   
}else{
    // echo "Connesso al database con successo";
}
?>
