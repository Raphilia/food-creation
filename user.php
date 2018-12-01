<?php
session_start();
if (!empty($_SESSION)) {
    echo '<html><head>
    <link rel="stylesheet" type="text/css" href="main.css">
    <meta http-equiv="refresh" content="4;url=logout.php" /></head>
    <body background="img/hanamura.png" style="overflow: hidden;">
    <center><br><h1><p class="overwatch">We made a u-turn.</p>
    <p class="overwatch"><i>You can\'t register while logged in.</i></p>
    <p class="overwatch">Logging you out...</p></h1>
    <div w3-include-html="overwatch-loader.html"></div>
    <!--LOAD EXTERNAL JAVASCRIPTS-->
    <script src="main.js"></script>
    <script>
    includeHTML();
    </script>
    </center>
    </body>
    </html>';
    exit;
}