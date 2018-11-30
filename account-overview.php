<?php
//this php is to obtain account information from session
include 'connect.php';
//obtain user id from session
if (session_status() == PHP_SESSION_NONE) { //start session if not started
    session_start();
}
//obtain data from session
$uid = $_SESSION['user_id'];
//run query
$q = "SELECT * FROM user WHERE user_id = " . $uid;
$result = mysqli_query($connect, $q);

if ($result) {
    //load status to session
    $_SESSION = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $u = $_SESSION['username'];
    $fn = $_SESSION['full_name'];
    $e = $_SESSION['email'];
    $a = $_SESSION['address'];
    $dob = $_SESSION['date_of_birth'];

    echo '<html><head><link rel="stylesheet" href="main.css"></head><body><p><b>
    <label>User ID</label><br>' .
        $uid . '<br><br>' .
        '<label>Username</label><br>' .
        $u . '<br><br>' .
        '<label>Full Name</label><br>' .
        $fn . '<br><br>' .
        '<label>Email Address</label><br>' .
        $e . '<br><br>' .
        '<label>Physical Address</label><br>' .
        $a . '<br><br>' .
        '<label>Date of Birth (YYYY/MM/DD)</label><br>' .
        $dob . '<br></b></p></body></html>';
} else {
    //error handling
    echo '<h1>System error.</h1>';
    echo '<p>' . mysqli_error($connect) . '<br><br>Query: ' . $q . '</p>';
}
mysqli_free_result($result);
mysqli_close($connect);