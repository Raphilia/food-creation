<?php
include "connect.php";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //append form input into global variables
    $u = mysqli_escape_string( $connect, trim( $_POST[ 'username' ] ) );
    $p = mysqli_escape_string( $connect, trim( $_POST[ 'password' ] ) );
    $f = mysqli_escape_string( $connect, trim( $_POST[ 'full_name' ] ) );
    $e = mysqli_escape_string( $connect, trim( $_POST[ 'email' ] ) );
    $a = mysqli_escape_string( $connect, trim( $_POST[ 'address' ] ) );
    $dob = mysqli_escape_string( $connect, trim( $_POST[ 'dob' ] ) );
    //make the query
    $q = "Insert INTO users(userID, username, password, fullName, email, address, birthDate)
    VALUES('', '$u', '$p', '$f', '$e', '$a', '$dob')";
    //run the query
    $result = @mysqli_query($connect, $q);
    if ($result) { //if successful display confirmation page
        echo '<html><head><link rel="stylesheet" type="text/css" href="main.css">
            <meta http-equiv="refresh" content="4;url=login.html" /></head>
            <body><center><br><img src="img/logo.png" alt="foodcreation" width="200"/><br><br>
            <h1>Registration Successful.<br><br>Welcome to the club, <b>'.$u.'</b>!<br><br>Constructing additional pylons...</h1>
            <br><img src="img/rainbow-loader.gif" height="150"></center></body></html>';
        exit();
    } else { //error handling
        echo '<h1>System error.</h1>';
        echo '<p>' . mysqli_error($connect) . '<br><br>Query: ' . $q . '</p>';
    }
    mysqli_free_result($result);
    mysqli_close($connect);
    exit();
}