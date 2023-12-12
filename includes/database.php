<?php
$host       = "localhost";
$user       = "root";
$password   = "";
$database   = "book_collection";

$db = mysqli_connect($host, $user, $password, $database)
or die("Error: " . mysqli_connect_error());;
