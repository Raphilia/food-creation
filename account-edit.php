<?php
// this php is to edit information for an account
include 'connect.php';
//obtain user id from session
if (session_status() == PHP_SESSION_NONE) { //start session if not started
    session_start();
}
$uid = $_SESSION['user_id'];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $update = array(); //initialize array for user to see what has been changed

    //check for a name
    if (!empty($_POST['username'])) {
        $u = mysqli_escape_string($connect, trim($_POST['username']));
        $q = 'UPDATE user SET username = "' . $u . '" WHERE user_id = ' . $uid;
        $result = mysqli_query($connect, $q);
        if ($result) {
            $update[] = 'username';
        } else { //error handling
            echo '<p>' . mysqli_error($connect) . '<br><br>Query: ' . $q . '</p>';
        }
    }

    //check for a full name
    if (!empty($_POST['full_name'])) {
        $fn = mysqli_escape_string($connect, trim($_POST['full_name']));
        $q = 'UPDATE user SET full_name = "' . $fn . '" WHERE user_id = ' . $uid;
        $result = mysqli_query($connect, $q);
        if ($result) {
            $update[] = 'full name';
        } else { //error handling
            echo '<p>' . mysqli_error($connect) . '<br><br>Query: ' . $q . '</p>';
        }
    }

    //check for email
    if (!empty($_POST['email'])) {
        $e = mysqli_escape_string($connect, trim($_POST['email']));
        $q = 'UPDATE user SET email = "' . $e . '" WHERE user_id = ' . $uid;
        $result = mysqli_query($connect, $q);
        if ($result) {
            $update[] = 'email';
        } else { //error handling
            echo '<p>' . mysqli_error($connect) . '<br><br>Query: ' . $q . '</p>';
        }
    }

    //check for address
    if (!empty($_POST['address'])) {
        $a = mysqli_escape_string($connect, trim($_POST['address']));
        $q = 'UPDATE user SET address = "' . $a . '" WHERE user_id = ' . $uid;
        $result = mysqli_query($connect, $q);
        if ($result) {
            $update[] = 'address';
        } else { //error handling
            echo '<p>' . mysqli_error($connect) . '<br><br>Query: ' . $q . '</p>';
        }
    }

    //check for date of birth
    if (!empty($_POST['dob'])) {
        $dob = mysqli_escape_string($connect, trim($_POST['dob']));
        $q = 'UPDATE user SET date_of_birth = "' . $dob . '" WHERE user_id = ' . $uid;
        $result = mysqli_query($connect, $q);
        if ($result) {
            $update[] = 'date of birth';
        } else { //error handling
            echo '<p>' . mysqli_error($connect) . '<br><br>Query: ' . $q . '</p>';
        }
    }
    //echo the complete output
    if (!empty($update)) {
        mysqli_close($connect);
        echo '<html>
        <head>
        <link rel="stylesheet" type="text/css" href="main.css">
        <meta http-equiv="refresh" content="4;url=account.html" />
        </head>
        <body>
        <center><br><img src="img/logo.png" alt="foocreation" width="200" /><br><br>
        <h1>Success! Your changes has been saved.<br><br>
        Meanwhile, here\'s what you\'ve edited:<br><p><b>'
        . implode(", ", $update) .
        '</b></p>Thinking of a joke...</h1>
        <img src="img/square-loader.gif" alt="nyan" width="100">
        </center>
        </body>
        </html>';
    } else {
        echo '<html><head>
        <link rel="stylesheet" type="text/css" href="main.css">
        <meta http-equiv="refresh" content="4;url=account.html" /></head>
        <body background="img/hanamura.png" style="overflow: hidden;">
        <center><br><h1><p class="overwatch">Not trying to change anything, I see...</p>
        <p class="overwatch"><i>*facepalm*</i></p>
        <p class="overwatch">Travelling to Hanamura</p></h1>
        <div w3-include-html="overwatch-loader.html"></div>
        <!--LOAD EXTERNAL JAVASCRIPTS-->
        <script src="main.js"></script>
        <script>
        includeHTML();
        </script>
        </center>
        </body>
        </html>';
    }
}
