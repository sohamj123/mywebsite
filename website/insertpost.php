<?php
$servername = "localhost";
$username = "root";
$password = "";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
var sql ="INSERT INTO post (title, take) VALUES ('" + $_POST["title"] + "')"

echo "Connected successfully";
echo ;
?>