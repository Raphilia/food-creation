<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include 'connect.php';
    //obtain user id from session
    if (session_status() == PHP_SESSION_NONE) { //start session if not started
        session_start();
    }
    //obtain user id from session
    $uid = $_SESSION['userID'];
    $q = "DELETE FROM reservations WHERE userID = " . $uid;
    $result = mysqli_query($connect, $q);
    if ($result) { //display confirmation page
        echo '<html>
            <head>
            <link rel="stylesheet" type="text/css" href="main.css">
            <meta http-equiv="refresh" content="4;url=reservation.html" />
            </head>
            <body><center><br><img src="img/logo.png" alt="foodcreation" width="200"/><br><br>
            <h1>Reservation cancelled.<br><br>Increasing anger level...</h1>
            <br><img  class="image-rotate" src="img/angery.png" height="150"></center>
            </body>
            </html>';
        exit();
    } else { //error handling
        echo '<h1>System error.</h1>';
        echo '<p>' . mysqli_error($connect) . '<br><br>Query: ' . $q . '</p>';
    }
    mysqli_free_result($result);
    mysqli_close($connect);
    exit();
}
