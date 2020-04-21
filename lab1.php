<?php 

include_once 'DBConnector.php';
include_once 'user.php';

$con = new DBConnector;

if (isset($_POST['btn-save'])) {
	$first_name = $_POST['first_name'];
	$last_name = $_POST['last_name'];
	$city = $_POST['city_name'];

	$user = new User($first_name,$last_name,$city);
	$res = $user->save();

	if ($res) {
		echo "Save operation was successful";
	}else{
		echo "An error occured!";
	}
}


 ?>

<!DOCTYPE html>
<html>
<head>
	<title>lab1</title>
</head>
<body>
	<form method="post">
		<div><input type="text" name="first_name" placeholder="first name..."></div>
		<div><input type="text" name="last_name" placeholder="last name..."></div>
		<div><input type="text" name="city_name" placeholder="city name..."></div>
		<div><button type="submit" name="btn-save"><strong>SAVE</strong></button></div>
	</form>
	<?php 

	$user = new User(null,null,null);
	$user->readAll();
	$con->closeDatabase();

	 ?>
</body>
</html>