<?php
require "./include/connect.php";
session_start();

if (isset($_SESSION['logged']) AND $_SESSION['logged'] === true) {
	header("Location: ../src/");
	return;
}

$email = strtolower($_POST['email']);
$password = md5($_POST['password']);

if (!isset($email) || !isset($password)){
	header("location: ../src/login/");
	return;
}

$sql = "SELECT * FROM utenti WHERE email = '$email' AND password = '$password'";
$res = $conn -> query($sql);

if ($res -> num_rows > 0) {
	$_SESSION['logged'] = true;
	header("location: ../src/");
	return;
}

header("location: ../src/login/");

$conn->close();
?>
