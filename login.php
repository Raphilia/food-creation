<?php
include "connect.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //apend form value to global variables
    $u = mysqli_real_escape_string($connect, $_POST['username']);
    $p = mysqli_real_escape_string($connect, $_POST['password']);
    //make query, attach to result and run it
    $q = "SELECT * FROM user WHERE (username = '$u' AND password = '$p')";
    $result = mysqli_query($connect, $q);
    if (@mysqli_num_rows($result) == 1) { //if one account is found
        session_start();
        $_SESSION = mysqli_fetch_array($result, MYSQLI_ASSOC);
        echo '<html><head><link rel="stylesheet" href="main.css">
            <meta http-equiv="refresh" content="4;url=home.html"/></head>
            <body><center><br><img src="img/logo.png" alt="foodcreation" width="200"/><br><br>
            <h1>Login Successful.<br><br>Welcome, <b>' . $u . '</b>!<br><br>Updating Windows 10...
            <div class="lds-ring"><div></div><div></div><div></div><div></div></div></h1></center></body></html>';
        exit();
    } else { //if no account is found
        echo '<html><head><link rel="stylesheet" type="text/css" href="main.css">
            <meta http-equiv="refresh" content="4;url=login.html" /></head>
            <body><center><br><img src="img/logo.png" alt="foodcreation" width="200"/><br><br>
            <h1>Oops!<br><br>That account seems to have vanished.<br><br>Resurrecting memes...
            <img src="img/nyancat.gif" alt="nyan" width="100"></h1></center></body></html>';
        exit();
    }
    mysqli_free_result($result);
    mysqli_close($connect);
}
