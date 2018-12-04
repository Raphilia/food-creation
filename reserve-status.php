<?php
//this php is to obtain reservation information for reservation page
include 'connect.php';
//obtain user id from session
if (session_status() == PHP_SESSION_NONE) { //start session if not started
    session_start();
}
$uid = $_SESSION['userID'];
//run query
$q = "SELECT r.reserveID, r.reserveVenue, r.reserveDate, r.reserveTime, u.username, u.userID FROM reservations r INNER JOIN users u ON r.userID=u.userID WHERE r.userID = " . $uid;
$result = mysqli_query($connect, $q);
//load status to session
$_SESSION = mysqli_fetch_array($result, MYSQLI_ASSOC);

if (@mysqli_num_rows($result)) { //if a placement is found
    echo '
    <html>
    <head>
    <link rel="stylesheet" href="main.css">
    </head>
    <body><p><b>
    <label>Reserve No.</label><br>' .
    $_SESSION['reserveID'] . '<br><br>' .
    '<label>Venue</label><br>' .
    $_SESSION['reserveVenue'] . '<br><br>' .
    '<label>Date (YYYY/MM/DD)</label><br>' .
    $_SESSION['reserveDate'] . '<br><br>' .
    '<label>Time</label><br>' .
    $_SESSION['reserveTime'] . '<br>' .
    '</b></p></body>
    </html>';
} else { //if user has not placed any reservation
    echo '
    <html>
    <head>
    <link rel="stylesheet" href="main.css">
    </head>
    <body><b>
    <label>You have not placed any reservation yet.<br>
    How about making one?<br><br></label>
    </b></body>
    </html>';
}
mysqli_free_result($result);
mysqli_close($connect);