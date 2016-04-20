<?php
$servername = "localhost";
$username = "wiinik";
$password = "288h8i";
$database = "wiinik_landing";

$name = $_POST['name'];
$email = $_POST['email'];
$company = $_POST['company'];
$position = $_POST['position'];
$phone = $_POST['phone'];



// Create connection
$conn = new mysqli($servername, $username, $password, $database);
// Check connection
if ($conn->connect_errno) {
    die("Connection failed: " . $conn->connect_errno);
} 

if (!$conn->query("insert into registro_wiinik (name, email, company, position, phone) values ('" . $name . "','" . $email . "','" . $company . "','". $position ."','" . $phone . "')")){
	echo "Query failed: (" . $conn->errno . ") " . $conn->error;
}else{
	echo "si";
}
?>