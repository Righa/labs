<?php 

include 'crud.php';
/**
 * 
 */
class User implements Crud
{
	private $user_id;
	private $first_name;
	private $last_name;
	private $city_name;

	function __construct($first_name,$last_name,$city_name)
	{
		$this->first_name = $first_name;
		$this->last_name = $last_name;
		$this->city_name = $city_name;
	}


	public function save()
	{
		$con = new DBConnector();
		$fn = $this->first_name;
		$ln = $this->last_name;
		$city = $this->city_name;
		$res = mysqli_query($con->conn, "INSERT INTO user(first_name,last_name,user_city) VALUES('$fn','$ln','$city')") or die("Error: ".$con->error);
		return $res;
	}

	public function readAll() {
		$con = new DBConnector();
		$users = mysqli_query($con->conn, "SELECT * FROM user") or die("Error: ".$con->error);
		echo "<table>";
		while ($user = $users->fetch_assoc()) {
			echo "<tr><td>".$user['id']."</td><td>".$user['first_name']."</td><td>".$user['last_name']."</td><td>".$user['user_city']."</td></tr>";
		}
		echo "</table>";
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
}


 ?>
 