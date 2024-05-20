<?php
require "./include/connect.php";
session_start();

if (isset($_SESSION['logged']) AND $_SESSION['logged'] === true) {
	header("Location: ../src/");
	return;
}

$email = strtolower($_POST["email"]);
$password = md5($_POST["password"]);

if (!isset($username) || !isset($email) || !isset($password)) {
	header("location: ../src/register/");
}

$sql = "SELECT * FROM utenti WHERE email ='$email' AND password = '$password'";
$res = $conn->query($sql);

if ($res->num_rows > 0) {
	header("location: ../src/register/");
	return;
}

$sql = "INSERT INTO utenti(email, password) VALUES ('$email', '$password')";

if ($conn->query($sql) === TRUE) {
	$_SESSION['logged'] = true;
	header("location: ../src/");
	return;
}

header("location: ../src/register/");

$conn->close();
?>