<?php
/* PROTECT PAGES THAT REQUIRE LOG IN */
session_start();
if (empty($_SESSION)) {
    header("Location: login.html");
    exit;
}