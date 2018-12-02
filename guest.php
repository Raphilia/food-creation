<?php //this php protects pages that require log in
session_start();
if (empty($_SESSION)) {
    header("Location: login.html");
    exit;
}