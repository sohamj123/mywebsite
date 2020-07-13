<?php 
    // connect to the database
    $ini = parse_ini_file('app.ini');
    $servername = $ini["servername"];
    $username = $ini["username"];
    $password = $ini["password"];
    $dbname = $ini["dbname"];
	$con = new mysqli($servername, $username, $password, $dbname);

	if (isset($_POST['liked'])) {
		$postid = $_POST['postid'];
		$result = mysqli_query($con, "SELECT likes FROM post WHERE postid=$postid");
		$row = mysqli_fetch_array($result);
		$n = $row['likes'];
        mysqli_query($con, "UPDATE post SET likes=$n + 1 WHERE postid=$postid");
        echo $n+1;
		exit();
	}
	if (isset($_POST['unliked'])) {
		$postid = $_POST['postid'];
		$result = mysqli_query($con, "SELECT dislikes FROM post WHERE postid=$postid");
		$row = mysqli_fetch_array($result);
		$n = $row['dislikes'];

		mysqli_query($con, "UPDATE post SET dislikes=$n+1 WHERE postid=$postid");
		
		echo $n+1;
		exit();
	}

	// Retrieve posts from the database
	//$posts = mysqli_query($con, "SELECT * FROM posts");
?>