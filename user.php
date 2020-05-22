<?php 

include 'crud.php';
include 'authenticate.php';
/**
 * 
 */
class User implements Crud,Authenticator
{
	private $user_id;
	private $first_name;
	private $last_name;
	private $city_name;
	private $username;
	private $password;
	private $offset;
	private $utc_timestamp;


	public function setFirstName($first_name)
	{
		$this->first_name = $first_name;
	}
	public function getFirstName()
	{
		return $this->first_name;
	}

	public function setLastName($last_name)
	{
		$this->last_name = $last_name;
	}
	public function getLastName()
	{
		return $this->last_name;
	}

	public function setCityName($city_name)
	{
		$this->city_name = $city_name;
	}
	public function getCityName()
	{
		return $this->city_name;
	}

	public function setUserName($username)
	{
		$this->username = $username;
	}
	public function getUserName()
	{
		return $this->username;
	}

	public function setProfilePic($pic)
	{
		$this->pic = $pic;
	}
	public function getProfilePic()
	{
		return $this->pic;
	}

	public function setUserId($user_id)
	{
		$this->user_id = $user_id;
	}
	public function getUserId()
	{
		return $this->user_id;
	}

	public function setUtcTimestamp($utc_timestamp)
	{
		$this->utc_timestamp = $utc_timestamp;
	}
	public function getUtcTimestamp()
	{
		return $this->utc_timestamp;
	}

	public function setTimeZoneOffset($offset)
	{
		$this->offset = $offset;
	}
	public function getTimeZoneOffset()
	{
		return $this->offset;
	}

	public function setPassword($password)
	{
		$this->password = $password;
	}
	public function getPassword()
	{
		return $this->password;
	}

	public static function create()
	{
		$instance = new self;
		return $instance;
	}








	public function save()
	{
		$con = new DBConnector;
		$fn = $this->first_name;
		$ln = $this->last_name;
		$city = $this->city_name;
		$uname = $this->username;
		$this->hashPassword();
		$pass = $this->password;
		$pic = $this->pic;
		$user_utc = $this->utc_timestamp;
		$offset = $this->offset;
		$res = mysqli_query($con->conn, "INSERT INTO user(first_name,last_name,user_city,username,password,profile_pic,user_utc_timestamp,user_offset) VALUES('$fn','$ln','$city','$uname','$pass','$pic','$user_utc','$offset')") or die("Error: ".$con->error);
		return $res;
	}

	public function readAll() {
		$con = new DBConnector();
		$users = mysqli_query($con->conn, "SELECT * FROM user") or die("Error: ".$con->error);
		
		$con->closeDatabase();
		
		return $users;

	}

	public function readUnique() {
		return null;
	}

	public function search() {
		return null;
	}

	public function update() {
		return null;
	}

	public function removeOne() {
		return null;
	}

	public function removeAll() {
		return null;
	}

	public function isUserExist()
	{
		$con = new DBConnector;

		$res = mysqli_query($con->conn, "SELECT * FROM user") or die("Error: ".$con->conn->error);

		$con->closeDatabase();

		while ($row = $res->fetch_assoc()) {
			if ($this->username == $row['username']) {
				return true;
			}
		}
		return false;
	}

	public function validateForm()
	{
		$fn = $this->first_name;
		$ln = $this->last_name;
		$city = $this->city_name;
		$uname = $this->username;
		$pass = $this->password;

		if ($fn == "" || $ln == "" || $city == "" || $uname == "" || $pass == "") {
			return false;
		}
		return true;
	}

	public function createFormErrorSessions($problem)
	{
		session_start();
		$_SESSION['form_errors'] = $problem;
	}

	public function hashPassword()
	{
		$this->password = password_hash($this->password, PASSWORD_DEFAULT);
	}

	public function isPasswordCorrect()
	{
		$con = new DBConnector;
		$found = false;
		$res = mysqli_query($con->conn, "SELECT * FROM user") or die("Error: ".$con->conn->error);

		while ($row = $res->fetch_assoc()) {
			if (password_verify($this->password, $row['password']) && $this->username == $row['username']) {
				$found = true;
			}
		}

		$con->closeDatabase();
		return $found;
	}

	public function login()
	{
		if ($this->isPasswordCorrect()) {
			header("location:private_page.php");
		}
	}

	public function createUserSession()
	{
		session_start();
		$_SESSION['username'] = $this->username;
	}

	public function logout()
	{
		session_start();
		unset($_SESSION['username']);
		session_destroy();
		header("location:login.php");
	}
}


 ?>
 