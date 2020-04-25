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

	# $args func_get_args();
	# call_user_func_array(array($this, 'parent::__construct'), $args);

	private $username;
	private $password;

	function __construct($first_name,$last_name,$city_name,$username,$password)
	{
		$this->first_name = $first_name;
		$this->last_name = $last_name;
		$this->city_name = $city_name;
		$this->username = $username;
		$this->password = $password;
	}

	public function setUserId($user_id)
	{
		$this->user_id = $user_id;
	}

	public function getUserId()
	{
		return $this->user_id;
	}

	public function setUsername($username)
	{
		$this->username = $username;
	}

	public function getUsername()
	{
		return $this->username;
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
		$instance = new self(null,null,null,null,null);
		return $instance;
	}

	public function save()
	{
		$con = new DBConnector();
		$fn = $this->first_name;
		$ln = $this->last_name;
		$city = $this->city_name;
		$uname = $this->username;
		$this->hashPassword();
		$pass = $this->password;
		$res = mysqli_query($con->conn, "INSERT INTO user(first_name,last_name,user_city,username,password) VALUES('$fn','$ln','$city','$uname','$pass')") or die("Error: ".$con->error);
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
			if ($this->getUsername() == $row['username']) {
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
			if (password_verify($this->getPassword(), $row['password']) && $this->getUsername() == $row['username']) {
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
		$_SESSION['username'] = $this->getUsername();
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
 