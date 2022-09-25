<!DOCTYPE html>
<html lang="en">

<head>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
  <title>Stay Indoors</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script type="text/javascript"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

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

$sql = sprintf('SELECT postid, take, likes, dislikes,picname,username FROM post');
$result = $conn->query($sql);
#echo $sql;
#echo $result->num_rows;
?>

<body>

  <div class="container">
      <nav class="navbar navbar-expand-lg navbar-light bg-light">
          <a class="navbar-brand" href="NBATAKES.php">home</a>
          <a class="navbar-brand" href="myaccount.php">my account</a>
          <a href="logout.php" id="signOut" class="btn btn-danger">Sign Out</a>
        
      </nav>
    
    <div class="container">


      <?php
      while ($row = $result->fetch_assoc()) {

      ?>
        <?php echo sprintf('<a href="take.php?postid=%s" style="text-decoration: none;color: black;">', $row["postid"]) ?>
        <div class="card">
          <div class="card-body">
            <h5 class="card-title"><?php echo $row["username"] ?></h5>

            <?php
            if ($row['picname'] != NULL) {
            ?>
              <img src="uploadedpic/<?php echo $row["picname"] ?>" style="height:100px;width=100px;" />
            <?php
            }
            ?>

            <p class="card-text"><?php echo $row["take"] ?></p>
            <span class=""><i class="fa fa-thumbs-o-up"></i></span>
            <span class="likes_count"><?php echo $row["likes"] ?>&nbsp;&nbsp;&nbsp;</span>
            <span class=""><i class="fa fa-thumbs-o-down"></i></span>
            <span class="unlikes_count"><?php echo $row["dislikes"] ?>&nbsp;&nbsp;&nbsp;</span>

          </div>
        </div>
        </a>
      <?php
      }
      $conn->close();
      ?>

    </div>
    <br />
    <br />
    <br />
    <div class="fixed-bottom">
      <div class="container">
        <div class="row">
          <div class="col-1">
            <div style="height: 90px;">
              <a href="newTake.html" title="">
                <svg class="bi bi-plus-circle" width="80px" height="80px" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                  <title> New Take </title>
                  <path fill-rule="evenodd" d="M8 3.5a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-.5.5H4a.5.5 0 0 1 0-1h3.5V4a.5.5 0 0 1 .5-.5z" />
                  <path fill-rule="evenodd" d="M7.5 8a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1H8.5V12a.5.5 0 0 1-1 0V8z" />
                  <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                </svg>
              </a>
            </div>
          </div>
          <div class="col-10"></div>
          <div class="col-1">
            <div style="height: 90px;">
              <a href="newPost.html" title="">
                <svg class="bi bi-plus-circle" width="80px" height="80px" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                  <title> New Post </title>
                  <path fill-rule="evenodd" d="M8 3.5a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-.5.5H4a.5.5 0 0 1 0-1h3.5V4a.5.5 0 0 1 .5-.5z" />
                  <path fill-rule="evenodd" d="M7.5 8a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1H8.5V12a.5.5 0 0 1-1 0V8z" />
                  <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                </svg>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
<script>
  $('#signOut').on('click', function() {
        $.ajax({
          url: 'logout.php',
          type: 'post',
          success: function(response) {
            alert("you are logged out")
          }
        });
      });
</Script>

</html>