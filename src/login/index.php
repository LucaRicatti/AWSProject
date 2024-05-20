<?php
session_start();

if (isset($_SESSION['logged']) AND $_SESSION['logged'] === true) {
	header("Location: ../");
	return;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../../css/loginRegisterStyle.css">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Kanit:wght@400;500&display=swap" rel="stylesheet">
	<title>Progetto AWS</title>
</head>
<body>
	<div class="container">
		<form action="../../php/login.php" method="post">
			<div class="form-box">
				<div class="form-header">
					<h2>Login</h2>
				</div>
				<div class="form-input-container">
					<div class="input">
						<h4>Email</h4>
						<input class="shadow" type="email" name="email" required>
					</div>
					<div class="input">
						<h4>Password</h4>
						<input class="shadow" type="password" name="password" required>
					</div>
				</div>
				<div class="form-footer">
					<a href="../register/">Non ho un account.</a>
					<input class="shadow" type="submit" value="Entra">
				</div>
			</div>
		</form>
	</div>
</body>
</html>