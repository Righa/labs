<?php 

include_once 'DBConnector.php';
include_once 'user.php';

$con = new DBConnector;

if (isset($_POST['btn-save'])) {
	$first_name = $_POST['first_name'];
	$last_name = $_POST['last_name'];
	$city = $_POST['city_name'];
	$username = $_POST['username'];
	$password = $_POST['password'];

	$user = new User($first_name,$last_name,$city,$username,$password);

	if (!$user->validateForm()) {
		$user->createFormErrorSessions('All fields are required');
		header("Refresh:0");
		die();
	}

	if ($user->isUserExist()) {
		$user->createFormErrorSessions('Username has been taken');
		header("Refresh:0");
		die();
	}

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
	<script type="text/javascript" src="validate.js"></script>
	<link rel="stylesheet" type="text/css" href="validate.css">
</head>
<body>
	<form method="post" id="user_details" name="user_details" onsubmit="return validateForm()" action="<?=$_SERVER['PHP_SELF']?>">
		<div id="form-errors">
			<?php 
			session_start();
			if (!empty($_SESSION['form_errors'])) {
				echo " ". $_SESSION['form_errors'];
				unset($_SESSION['form_errors']);
			}
			 ?>
		</div>
		<div><input type="text" name="first_name" placeholder="first name..."></div>
		<div><input type="text" name="last_name" placeholder="last name..."></div>
		<div><input type="text" name="city_name" placeholder="city name..."></div>
		<div><input type="text" name="username" placeholder="user name..."></div>
		<div><input type="password" name="password" placeholder="password..."></div>
		<div><button type="submit" name="btn-save"><strong>SAVE</strong></button></div>
		<div><a href="login.php">Login</a></div>
	</form>
	<table id="users-tab">
		<tr><th>ID</th><th>USERNAME</th><th>FIRST NAME</th><th>LAST NAME</th><th>CITY</th></tr>
	<?php 

	$users = new User(null,null,null,null,null);

	$users = $users->readAll();

	while ($user = $users->fetch_assoc()) {
		echo "<tr><td>".$user['id']."</td><td>".$user['username']."</td><td>".$user['first_name']."</td><td>".$user['last_name']."</td><td>".$user['user_city']."</td></tr>";
	}
	

	 ?>
	 	
	</table>
</body>
</html>