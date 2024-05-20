<?php
$dbhost = "localhost"; //"44.222.225.194";
$dbuser = "root"; //"admin";
$dbpass = ""; //"password";
$dbname = "AWS";
$dbport = 3306;
$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname, $dbport);

if($conn -> error){
	echo "Connection error";   
}else{
    // echo "Connesso al database con successo";
}
?>