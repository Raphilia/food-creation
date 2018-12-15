<?php
/* EDIT RESERVATION FOR CURRENT ACCOUNT */
include 'connect.php';
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$uid = $_SESSION['userID'];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //run select query to check if there's a placement to be edited
    $q = "SELECT * FROM reservations WHERE userID = " . $uid;
    $result = mysqli_query($connect, $q);
    $rows = mysqli_num_rows($result);
    if ($rows > 0) { //if placement is found
        //proceed to editing the placement
        $d = mysqli_escape_string($connect, trim($_POST['date']));
        $t = mysqli_escape_string($connect, trim($_POST['time']));
        $q = "UPDATE reservations SET reserveDate = '". $d . "' , reserveTime = '". $t .
        "' WHERE userID = ". $uid;
        $result = @mysqli_query($connect, $q);
        if ($result) { //display confirmation page
            echo '<html>
            <head>
            <link rel="stylesheet" type="text/css" href="main.css">
            <meta http-equiv="refresh" content="4;url=reservation.html" />
            </head>
            <body><center><br><img src="img/logo.png" alt="laneige" width="200"/><br><br>
            <h1>Success! Your reservation has been edited.<br><br>
            Breaking the speed limit...</h1>
            <br><img src="img/speedo.gif" height="150"></center>
            </body>
            </html>';
            exit();
        } else { //error handling
            echo '<h1>System error.</h1>';
            echo '<p>' . mysqli_error($connect) . '<br><br>Query: ' . $q . '</p>';
        }
    } else { //else display no placement found
        echo '<html>
        <head>
        <link rel="stylesheet" type="text/css" href="main.css">
        <meta http-equiv="refresh" content="3;url=reservation.html" />
        </head>
        <body><center><br><img src="img/logo.png" alt="laneige" width="200"/><br><br>
        <h1>You currently have no placement to be edited.<br><br>
        How about making one?<br><br>
        Redirecting in 3 seconds...</h1></center>
        </body>
        </html>';
    }
    mysqli_free_result($result);
    mysqli_close($connect);
}