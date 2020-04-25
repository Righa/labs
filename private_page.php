<?php 

session_start();
if (!isset($_SESSION['username'])) {
	header("location:login.php");
}

 ?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<p>This is a private page</p>
	<p>We want to protect it</p>
	<p><a href="logout.php">Logout</a><?php echo ": ".$_SESSION['username']; ?></p>
</body>
</html>