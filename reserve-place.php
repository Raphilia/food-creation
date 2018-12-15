<?php
/* PLACE RESERVATION FOR CURRENT ACCOUNT */
include "connect.php";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    $uid = $_SESSION['userID'];
    //run select query to check if a placement already exist
    $q = "SELECT * FROM reservations WHERE userID = " . $uid;
    $result = mysqli_query($connect, $q);
    $rows = mysqli_num_rows($result);
    if ($rows > 0) { //check if placement already exist
        //display restriction message
        echo '<html><head><link rel="stylesheet" href="main.css">
        <meta http-equiv="refresh" content="4;url=reservation.html"/></head>
        <body><center><br><img src="img/logo.png" alt="foodcreation" width="200"/><br><br>
        <h1>Oh noes!<br><br>Only one reservation at a time for now.<br><br>Going round and round...
        <img class="image-rotate" src="img/fidgetspinner.png" alt="nyan" width="100"></h1></center></body></html>';
    } else { //else proceed to place order
        $v = mysqli_escape_string($connect, trim($_POST['venue']));
        $d = mysqli_escape_string($connect, trim($_POST['date']));
        $t = mysqli_escape_string($connect, trim($_POST['time']));
        $q = "Insert INTO reservations(reserveID, reserveVenue, reserveDate, reserveTime, userID)
        VALUES('', '$v', '$d', '$t', '$uid')";
        $result = @mysqli_query($connect, $q);

        if ($result) { //display confirmation page
            echo '<html><head><link rel="stylesheet" href="main.css">
            <meta http-equiv="refresh" content="4;url=reservation.html"/></head>
            <body><center><br><img src="img/logo.png" alt="foodcreation" width="200"/><br><br>
            <h1>Success!<br><br>Your reservation has been placed.<br><br>Hold my beer...
            <div class="lds-ring"><div></div><div></div><div></div><div></div></div></h1></center></body></html>';
            exit();
        } else { //error handling
            echo '<h1>System error.</h1>';
            echo '<p>' . mysqli_error($connect) . '<br><br>Query: ' . $q . '</p>';
        }
        mysqli_close($connect);
        exit();
    }
    mysqli_free_result($result);
}
