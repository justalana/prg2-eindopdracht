<?php
//check if user is logged in
$loggedin = false;
session_start();
$loggedin = $_SESSION['loggedin'];

if (!$loggedin) {
    header("location: index.php");
    exit;
}

?>
