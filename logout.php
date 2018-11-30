<?php
session_start(); //start session
session_unset(); //remove session
echo '<html><head><link rel="stylesheet" href="main.css">
<meta http-equiv="refresh" content="4;url=home.html"/></head>
<body><center><br><img src="img/logo.png" alt="foodcreation" width="200"/><br><br>
<h1>Logout Successful.<br><br>Thanks for stopping by!</b><br><br>Packing things up...
<div class="lds-ring"><div></div><div></div><div></div><div></div></div></h1></center></body></html>';
exit;