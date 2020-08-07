<?php
session_start();

$ini = parse_ini_file('app.ini');
$servername = $ini["servername"];
$username = $ini["username"];
$password = $ini["password"];
$dbname = $ini["dbname"];

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

date_default_timezone_set('America/New_York');
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$username = $conn->real_escape_string($_SESSION["username"]);

$sql = sprintf('INSERT INTO post (take,picname, dt,username) VALUES ("%s", "%s", "%s","%s")'
          , $conn->real_escape_string($_POST["take"]) 
          , $conn->real_escape_string($_POST["picname"]) 
          , date("Y-m-d H:i:s")
          , $username);


if ($conn->query($sql) === TRUE) {
  echo "New record created successfully. " . date_default_timezone_get() ;
  $_SESSION['id'] = $conn->insert_id;
  header(sprintf("Location: take.php?postid=%s",$conn->insert_id));
  exit();
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

?>