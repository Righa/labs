<?php 

include_once 'DBConnector.php';
include_once 'user.php';
include_once 'fileUploader.php';

$con = new DBConnector;

if (isset($_POST['btn-save'])) {
	$first_name = $_POST['first_name'];
	$last_name = $_POST['last_name'];
	$city_name = $_POST['city_name'];

	$username = $_POST['username'];
	$password = $_POST['password'];

	$utc_timestamp = $_POST['utc_timestamp'];
	$offset = $_POST['time_zone_offset'];

	$file_size = $_FILES["fileToUpload"]["size"];
	$target_directory = "uploads/";
	$file_original_name = $_FILES["fileToUpload"]["name"];
	$file_temp_name = $_FILES["fileToUpload"]["tmp_name"];

	$uploader = new FileUploader($file_temp_name);
	$user = new User;

	$uploader->setOriginalName($file_original_name);
	$uploader->setFileSize($file_size);
	$uploader->setFinalFileName($target_directory.basename($file_original_name));
	$pic = $uploader->getFinalFileName();
	$uploader->setFileType(strtolower(pathinfo($pic,PATHINFO_EXTENSION)));

	$uploader->fileWasSelected();
	$uploader->fileAlreadyExists();
	$uploader->fileTypeIsCorrect();
	$uploader->fileSizeIsCorrect();

	$user->setFirstName($first_name);
	$user->setLastName($last_name);
	$user->setCityName($city_name);
	$user->setUserName($username);
	$user->setPassword($password);
	$user->setProfilePic($pic);

	$user->setUtcTimestamp($utc_timestamp);
	$user->setTimeZoneOffset($offset);



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

	if (!$uploader->uploadFile()) {
		$user->createFormErrorSessions('File not uploaded');
		header("Refresh:0");
		die();
	}

	$res = $user->save();


	if ($res) {
		echo "Save operation was successful";
	} else {
		echo "An error occured!";
		unlink($pic);
	}
}


 ?>

<!DOCTYPE html>
<html>
<head>
	<title>lab1</title>
	<script type="text/javascript" src="validate.js"></script>
	<link rel="stylesheet" type="text/css" href="validate.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script type="text/javascript" src="timezone.js"></script>

	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<body>
	<form enctype="multipart/form-data" method="post" id="user_details" name="user_details" onsubmit="return validateForm()" action="<?=$_SERVER['PHP_SELF']?>">
		<div id="form-errors">
			<?php 
			session_start();
			if (!empty($_SESSION['form_errors'])) {
				echo " ". $_SESSION['form_errors'];
				unset($_SESSION['form_errors']);
			}
			 ?>
		</div>
		<input type="hidden" name="utc_timestamp" id="utc_timestamp" value="">
		<input type="hidden" name="time_zone_offset" id="time_zone_offset" value="">
		<div><input type="text" name="first_name" placeholder="first name..."></div>
		<div><input type="text" name="last_name" placeholder="last name..."></div>
		<div><input type="text" name="city_name" placeholder="city name..."></div>
		<div><input type="text" name="username" placeholder="user name..."></div>
		<div><input type="password" name="password" placeholder="password..."></div>
		<div><label for="fileToUpload">Profile image:</label><input type="file" name="fileToUpload" id="fileToUpload"></div>
		<div><button class="btn btn-primary" type="submit" name="btn-save"><strong>SAVE</strong></button></div>
		<div><a href="login.php">Login</a></div>
	</form>
	<table id="users-tab">
		<tr><th>ID</th><th>USERNAME</th><th>FIRST NAME</th><th>LAST NAME</th><th>CITY</th><th>UTC TIMESTAMP</th><th>ZONE OFFSET</th><th>PIC</th></tr>
	<?php 

	$users = new User;

	$users = $users->readAll();

	while ($user = $users->fetch_assoc()) {
		echo "<tr><td>".$user['id']."</td><td>".$user['username']."</td><td>".$user['first_name']."</td><td>".$user['last_name']."</td><td>".$user['user_city']."</td><td>".$user['user_utc_timestamp']."</td><td>".$user['user_offset']."</td><td><img id='profile_pic' src='".$user['profile_pic']."'></td></tr>";
	}
	

	 ?>
	 	
	</table>
</body>
</html>
