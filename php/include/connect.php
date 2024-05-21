<?php
$dbhost = "db";
$dbuser = "root";
$dbpass = "mariadb";
$dbname = "AWS";
$dbport = 3306;
$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname, $dbport);

if($conn -> error){
	echo "Connection error";
}else{
	//echo "Connesso al database con successo";
}
?>
