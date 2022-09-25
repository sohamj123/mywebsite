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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<?php
function insert_reply()
{
    $ini = parse_ini_file('app.ini');
    $servername = $ini["servername"];
    $username = $ini["username"];
    $password = $ini["password"];
    $dbname = $ini["dbname"];

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    $postid = $_POST['postid'];
    $reply = $_POST['reply'];
    date_default_timezone_set('America/New_York');
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = sprintf(
        'INSERT INTO replies (postid,reply, dt) VALUES (%d, "%s","%s")',
        $postid,
        $conn->real_escape_string($reply),
        date("Y-m-d H:i:s")
    );
    $conn->close();
}
?>

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

$sql = sprintf('SELECT postid, take, likes, dislikes, picname, username FROM post where postid = %d;', $_GET['postid']);
$result = $conn->query($sql);

$sql2 = sprintf('SELECT replyid, reply FROM replies where postid = %d;', $_GET['postid']);
$result2 = $conn->query($sql2) or die($conn->error);


#echo $sql;
#echo $result->num_rows;
?>

<body>
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <?php
            if (isset($_SESSION["loggedin"]) == "true") {
            ?>
            <a class="navbar-brand" href="NBATAKES.php">home</a></nav>
            <?php
            } else {
            ?>
            <a class="navbar-brand" href="sportsTakesHome.php">home</a></nav>
            <?php
            }
            ?>

    <div class="container">
        <div class="card">
            <div class="card-body">
                <?php
                while ($row = $result->fetch_assoc()) {
                ?>

                    <h5 class="card-title"><?php echo $row["username"] ?></h5>
                    <?php
                    if ($row['picname'] != NULL) {
                    ?>
                    
                        <h5 class="card-title"><?php echo $row["title"] ?></h5>
                        <img src="uploadedpic/<?php echo $row["picname"] ?>" style="height:100px;width=100px;"/>

                        <?php
                        if (isset($_SESSION["loggedin"]) == "true") {
                        ?>
                            <div class="replybutton btn4 like">
                                <span class="btn reply" id="replyb">Reply</span>
                                <div class="input-group" id="replyText" style="display: none">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-anchor"></i></span>
                                    </div>
                                    <input type="text" id="reply" class="form-control pull-right reply" placeholder="Write a reply..." />
                                </div>
                            </div>
                        <?php
                        } else {
                        ?>
                            <span class="btn reply">Reply</span>
                        <?php
                        }
                        ?>
                    </div>
                <?php
                } }
                ?>
            </div>
        </div>
        <div class="card" id="wrapper">
            <?php
            while ($row = $result2->fetch_assoc()) {
            ?>
                <div class="card-header">
                    <p class="card-text"><?php echo $row["reply"] ?></p>
                </div>
            <?php
            }
            $conn->close();
            ?>
        </div>
    </div>
    <div class="fixed-bottom">
        <div class="container">
            <?php
            if (isset($_SESSION["loggedin"]) == "true") {
            ?>
                <div class="row">
                    <div class="col-9"></div>
                    <div class="col-3">
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
                </div>
            <?php
            } else {
            ?>
                <div class="row">
                    <div class="col-9"></div>
                    <div class="col-3">
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
                </div>
            <?php
            }
            ?>
        </div>
    </div>
</body>
<script type="text/javascript">
    $(document).ready(function() {
        // when the user clicks on like
        $('.like').on('click', function() {
            var postid = $(this).data('id');

            $post = $(this);

            $.ajax({
                url: 'likePost.php',
                type: 'post',
                data: {
                    'liked': 1,
                    'postid': postid
                },
                success: function(response) {
                    $post.parent().find('span.likes_count').text(response);
                    $post.addClass('hide');
                    $post.siblings().removeClass('hide');
                }
            });
        });

        // when the user clicks on unlike
        $('.unlike').on('click', function() {
            var postid = $(this).data('id');
            $post = $(this);

            $.ajax({
                url: 'likePost.php',
                type: 'post',
                data: {
                    'unliked': 1,
                    'postid': postid
                },
                success: function(response) {
                    $post.parent().find('span.unlikes_count').text(response);
                    $post.addClass('hide');
                    $post.siblings().removeClass('hide');
                }
            });
        });
    });



    $('#replyb').click(function() {
        $(this).next('#replyText').toggle();
    });

    $('#reply').keypress(function(event) {
        var keycode = (event.keyCode ? event.keyCode : event.which);
        if (keycode == '13') {
            newPerson();
        }
    });

    function newPerson() {
        $('#wrapper').append('<div class="card"><div class="card-header"><p class="card-text" id="wrapper">' + $('#reply')
            .val() + '</p></div></div>');
        $.ajax({
            url: "insertreplies.php",
            type: "POST",
            data: {
                postid: getUrlParameter('postid'),
                reply2: $('#reply').val()
            },
            dataType: "json"
        });
        $('#reply').val("");
    }

    function getUrlParameter(sParam) {
        var sPageURL = window.location.search.substring(1),
            sURLVariables = sPageURL.split('&'),
            sParameterName,
            i;

        for (i = 0; i < sURLVariables.length; i++) {
            sParameterName = sURLVariables[i].split('=');

            if (sParameterName[0] === sParam) {
                return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
            }
        }
    }
</script>

</html>