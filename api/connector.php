<?php
// db connector
$server_name = "localhost";
$username = "root";
$password = "";
$dbname = "savolho"; 

$conn = new mysqli($server_name, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Db connection error: " . $conn->connect_error);
}

?>