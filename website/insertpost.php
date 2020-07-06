<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "nbatakes";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

date_default_timezone_set('America/New_York');
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = sprintf('INSERT INTO post (title, take,dt) VALUES ("%s", "%s", "%s")', $_POST["title"] , $_POST["take"] , date("Y-m-d H:i:s") );

if ($conn->query($sql) === TRUE) {
  echo "New record created successfully. " . date_default_timezone_get() ;
  header("Location: take.html");
  exit();
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();


?>